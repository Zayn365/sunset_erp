<?php
// app/Http/Controllers/OrderEntryController.php
namespace App\Http\Controllers;

use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderEntryController extends Controller
{
    // create a new order (many lines) into ordersdetay
    public function store(Request $req)
    {
        $data = $req->validate([
            'fis_no' => ['nullable', 'string', 'max:45'],      // allow client to pass an existing fis_no, else we generate one
            'aciklama' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],

            'items.*.en' => ['required', 'numeric', 'gt:0'],
            'items.*.boy' => ['required', 'numeric', 'gt:0'],
            'items.*.miktar' => ['required', 'integer', 'min:1'],

            'items.*.m2_fiyat' => ['nullable', 'numeric', 'min:0'],
            'items.*.kdv_yuzde' => ['nullable', 'numeric', 'min:0'],
            'items.*.renk' => ['nullable', 'string', 'max:45'],
            'items.*.mekanizma' => ['nullable', 'string', 'max:45'],
            'items.*.mekanizma_yon' => ['nullable', 'string', 'max:45'],
            'items.*.sistem' => ['nullable', 'string', 'max:45'],

            'items.*.ic_cam' => ['nullable', 'string', 'max:45'],
            'items.*.dis_cam' => ['nullable', 'string', 'max:45'],
            'items.*.ic_cam_tutar' => ['nullable', 'numeric', 'min:0'],
            'items.*.dis_cam_tutar' => ['nullable', 'numeric', 'min:0'],

            'items.*.kasa_renk' => ['nullable', 'string', 'max:45'],
            'items.*.alt_kasa_renk' => ['nullable', 'string', 'max:45'],
            'items.*.cam_cita_renk' => ['nullable', 'string', 'max:45'],
        ]);

        // MyISAM has no transactions; keep logic simple and idempotent
        $fisNo = $data['fis_no'] ?? $this->generateFisNo();

        $inserted = [];
        foreach ($data['items'] as $line) {
            $en   = (float)$line['en'];
            $boy  = (float)$line['boy'];
            $m2   = max(1.0, round($en * $boy, 2));

            $qty  = (int)$line['miktar'];
            $m2Price = (float)($line['m2_fiyat'] ?? 0);
            $kdv   = (float)($line['kdv_yuzde'] ?? 0);

            $lineNet = $qty * $m2 * $m2Price;
            $lineKdvli = $kdv > 0 ? round($lineNet * (1 + $kdv / 100), 2) : $lineNet;

            $icCamTutar  = (float)($line['ic_cam_tutar']  ?? 0);
            $disCamTutar = (float)($line['dis_cam_tutar'] ?? 0);

            $toplam = round($lineKdvli + $icCamTutar + $disCamTutar, 2);

            $inserted[] = OrderLine::create([
                'fis_no' => $fisNo,
                'en' => $en,
                'boy' => $boy,
                'm2'  => $m2,

                'renk' => $line['renk'] ?? null,
                'mekanizma' => $line['mekanizma'] ?? null,
                'mekanizma_yon' => $line['mekanizma_yon'] ?? null,
                'sistem' => $line['sistem'] ?? null,

                'ic_cam' => $line['ic_cam'] ?? null,
                'dis_cam' => $line['dis_cam'] ?? null,

                'miktar' => $qty,
                'm2_fiyat' => $m2Price,
                'kdv_yuzde' => $kdv,

                'satir_tutar' => round($lineNet, 2),
                'satir_tutar_kdvli' => round($lineKdvli, 2),
                'ic_cam_tutar' => $icCamTutar,
                'dis_cam_tutar' => $disCamTutar,
                'toplam_tutar' => $toplam,

                'kasa_renk' => $line['kasa_renk'] ?? null,
                'alt_kasa_renk' => $line['alt_kasa_renk'] ?? null,
                'cam_cita_renk' => $line['cam_cita_renk'] ?? null,

                'aciklama' => $data['aciklama'] ?? null,
            ]);
        }

        return response()->json([
            'fis_no' => $fisNo,
            'lines'  => $inserted,
        ], 201);
    }

    // simple unique-ish fis_no (date + 4 digits). Replace if you already have your own generator.
    protected function generateFisNo(): string
    {
        $prefix = now()->format('Ymd');
        $seq = str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        return "FIS-{$prefix}-{$seq}";
    }

    // fetch an order by fis_no (grouped)
    public function show($fisNo)
    {
        $lines = OrderLine::where('fis_no', $fisNo)->orderBy('id')->get();
        abort_if($lines->isEmpty(), 404, 'Fiş bulunamadı');
        $sum = $lines->sum('toplam_tutar');
        return response()->json(['fis_no' => $fisNo, 'toplam' => $sum, 'lines' => $lines]);
    }
}
