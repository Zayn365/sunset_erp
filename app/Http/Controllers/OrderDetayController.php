<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetayController extends Controller
{
    public function index()
    {
        return view('admin.order.orderdetay'); // your blade path
    }

    public function data()
    {
        // If you have a real "orders" header table, use that.
        // Fallback: derive minimal headers from ordersdetay.
        if (DB::getSchemaBuilder()->hasTable('ordersdetay')) {

            $rows = DB::table('ordersdetay as d')
                ->limit(500)
                ->get();
        }

        return response()->json($rows);
    }
    public function store(Request $request)
    {
        $v = $request->validate([
            'fis_no'        => ['nullable', 'integer', 'min:1'], // optional: add to existing order
            'en'            => ['required', 'numeric'],
            'boy'           => ['required', 'numeric'],
            'miktar'        => ['required', 'numeric'],
            'm2_fiyat'      => ['required', 'numeric'],

            'aciklama'      => ['nullable', 'string'],
            'poz'           => ['nullable', 'string'],

            'renk'          => ['nullable', 'string'],
            'mekanizma_yon' => ['nullable', 'in:SOL,SAĞ'],
            'sistem'        => ['nullable', 'string'],
            'slayt'         => ['nullable', 'string'],
            'cam'           => ['required', 'in:Var,Yok'],
            'ic_cam'        => ['nullable', 'string'],
            'dis_cam'       => ['nullable', 'string'],
            'kasa_renk'     => ['nullable', 'string'],
            'alt_kasa_renk' => ['nullable', 'string'],
            'cam_cita_renk' => ['nullable', 'string'],
            // If you post kdv_yuzde later, you can add it here (defaults to 0 in DB)
        ]);

        // Rule: M2 = max(en*boy, 1), Tutar Doviz = miktar * m2 * m2_fiyat
        $m2         = max($v['en'] * $v['boy'], 1);
        $tutarDoviz = $v['miktar'] * $m2 * $v['m2_fiyat'];

        return DB::transaction(function () use ($v, $m2, $tutarDoviz) {
            $fisNo = $v['fis_no'] ?? $this->nextFisNo();

            // Insert detail row first (ordersdetay)
            DB::table('ordersdetay')->insert([
                'fis_no'         => $fisNo,
                'en'             => $v['en'],
                'boy'            => $v['boy'],
                'm2'             => round($m2, 2),
                'renk'           => $v['renk']          ?? '',
                'mekanizma_yon'  => $v['mekanizma_yon'] ?? '',
                'sistem'         => $v['sistem']        ?? '',
                'slayt'          => $v['slayt']         ?? '',
                'cam'            => $v['cam'],
                'ic_cam'         => $v['ic_cam']        ?? '',
                'dis_cam'        => $v['dis_cam']       ?? '',
                'm2_fiyat'       => $v['m2_fiyat'],
                'tutar_doviz'    => round($tutarDoviz, 2),
                // keep line totals aligned with your single-price rule
                'satir_tutar'          => round($tutarDoviz, 2),
                'satir_tutar_kdvli'    => round($tutarDoviz, 2), // adjust later if you start using KDV
                'tutar'                => round($tutarDoviz, 2),
                'miktar'         => $v['miktar'],
                'aciklama'       => $v['aciklama']      ?? null,
                'poz'            => $v['poz']           ?? null,
                'kasa_renk'      => $v['kasa_renk']     ?? '',
                'alt_kasa_renk'  => $v['alt_kasa_renk'] ?? '',
                'cam_cita_renk'  => $v['cam_cita_renk'] ?? '',
            ]);

            // Ensure/update header after the line insert
            $this->syncHeader($fisNo, $v['aciklama'] ?? null);

            return response()->json([
                'ok'     => true,
                'fis_no' => $fisNo,
                'total'  => $this->headerTotal($fisNo),
            ], 201);
        });
    }

    /** Show one detail line */
    public function show($id)
    {
        $row = DB::table('ordersdetay')->where('id', $id)->first();
        abort_if(!$row, 404);
        return response()->json($row);
    }

    /** List all detail lines of a given fiş */
    public function listByFis($fis)
    {
        $rows = DB::table('ordersdetay')
            ->where('fis_no', $fis)
            ->orderBy('id')
            ->get();

        return response()->json([
            'fis_no' => (int)$fis,
            'items'  => $rows,
            'total'  => $this->headerTotal((int)$fis),
        ]);
    }

    /** Update a detail line; re-calc derived values if size/price/qty changed, then resync header */
    public function update(Request $request, $id)
    {
        $row = DB::table('ordersdetay')->where('id', $id)->first();
        abort_if(!$row, 404);

        $v = $request->validate([
            'en'        => ['nullable', 'numeric'],
            'boy'       => ['nullable', 'numeric'],
            'miktar'    => ['nullable', 'numeric'],
            'm2_fiyat'  => ['nullable', 'numeric'],
            'aciklama'  => ['nullable', 'string'],
            'poz'       => ['nullable', 'string'],

            'renk'          => ['nullable', 'string'],
            'mekanizma_yon' => ['nullable', 'in:SOL,SAĞ'],
            'sistem'        => ['nullable', 'string'],
            'slayt'         => ['nullable', 'string'],
            'cam'           => ['nullable', 'in:Var,Yok'],
            'ic_cam'        => ['nullable', 'string'],
            'dis_cam'       => ['nullable', 'string'],
            'kasa_renk'     => ['nullable', 'string'],
            'alt_kasa_renk' => ['nullable', 'string'],
            'cam_cita_renk' => ['nullable', 'string'],
        ]);

        return DB::transaction(function () use ($v, $row, $id) {
            // Use existing values for unchanged fields
            $en       = array_key_exists('en', $v)       ? (float)$v['en']       : (float)$row->en;
            $boy      = array_key_exists('boy', $v)      ? (float)$v['boy']      : (float)$row->boy;
            $miktar   = array_key_exists('miktar', $v)   ? (float)$v['miktar']   : (float)$row->miktar;
            $m2_fiyat = array_key_exists('m2_fiyat', $v) ? (float)$v['m2_fiyat'] : (float)$row->m2_fiyat;

            $m2         = max($en * $boy, 1);
            $tutarDoviz = $miktar * $m2 * $m2_fiyat;

            $update = array_merge($v, [
                'en'          => $en,
                'boy'         => $boy,
                'miktar'      => $miktar,
                'm2_fiyat'    => $m2_fiyat,
                'm2'          => round($m2, 2),
                'tutar_doviz' => round($tutarDoviz, 2),
                'satir_tutar'       => round($tutarDoviz, 2),
                'satir_tutar_kdvli' => round($tutarDoviz, 2),
                'tutar'             => round($tutarDoviz, 2),
            ]);

            DB::table('ordersdetay')->where('id', $id)->update($update);

            $this->syncHeader((int)$row->fis_no, $v['aciklama'] ?? null);

            return response()->json([
                'ok'     => true,
                'fis_no' => (int)$row->fis_no,
                'total'  => $this->headerTotal((int)$row->fis_no),
            ]);
        });
    }

    /** Delete a detail line; resync (and optionally remove) header */
    public function destroy($id)
    {
        $row = DB::table('ordersdetay')->where('id', $id)->first();
        abort_if(!$row, 404);

        return DB::transaction(function () use ($row, $id) {
            DB::table('ordersdetay')->where('id', $id)->delete();

            // Recompute header total
            $sum  = $this->headerTotal((int)$row->fis_no);
            $cnt  = DB::table('ordersdetay')->where('fis_no', $row->fis_no)->count();

            if (DB::getSchemaBuilder()->hasTable('orders')) {
                if ($cnt > 0) {
                    DB::table('orders')->where('fis_no', $row->fis_no)
                        ->update(['teklif_doviz_tutar' => round($sum, 2)]);
                } else {
                    // If there are no more lines, you can either keep or remove the header.
                    DB::table('orders')->where('fis_no', $row->fis_no)->delete();
                }
            }

            return response()->json(['ok' => true, 'fis_no' => (int)$row->fis_no, 'total' => round($sum, 2)]);
        });
    }

    // ----------------- helpers -----------------

    protected function nextFisNo(): int
    {
        $maxOrders    = DB::getSchemaBuilder()->hasTable('orders') ? (int) (DB::table('orders')->max('fis_no') ?? 0) : 0;
        $maxDetay     = (int) (DB::table('ordersdetay')->max('fis_no') ?? 0);
        return max($maxOrders, $maxDetay) + 1;
    }

    protected function headerTotal(int $fisNo): float
    {
        return (float) DB::table('ordersdetay')->where('fis_no', $fisNo)->sum('tutar_doviz');
    }

    protected function syncHeader(int $fisNo, ?string $maybeAciklama = null): void
    {
        if (!DB::getSchemaBuilder()->hasTable('orders')) {
            return; // header table absent; skip gracefully
        }

        $sum    = $this->headerTotal($fisNo);
        $exists = DB::table('orders')->where('fis_no', $fisNo)->exists();

        if ($exists) {
            $data = ['teklif_doviz_tutar' => round($sum, 2)];
            if (!is_null($maybeAciklama) && $maybeAciklama !== '') {
                $data['aciklama'] = $maybeAciklama;
            }
            DB::table('orders')->where('fis_no', $fisNo)->update($data);
        } else {
            DB::table('orders')->insert([
                'fis_no'             => $fisNo,
                'tarih'              => now()->toDateString(),
                'aciklama'           => $maybeAciklama ?? '',
                'teklif_doviz_tutar' => round($sum, 2),
            ]);
        }
    }
}
