<?php

// app/Http/Controllers/OrderController.php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.order'); // your blade path
    }

    // LIST: headers you asked for
    public function data()
    {
        // If you have a real "orders" header table, use that.
        // Fallback: derive minimal headers from ordersdetay.
        if (DB::getSchemaBuilder()->hasTable('orders')) {
            $rows = DB::table('orders as o')
                // ->select('o.fis_no', 'o.siparis_tarih', 'o.konu', 'o.marka', 'o.teslimat_tipi', 'o.kargo_no', 'o.dolgu')
                ->orderByDesc('o.id')->limit(500)->get();
        } else {
            $rows = DB::table('ordersdetay as d')
                ->selectRaw('MAX(d.fis_no) as fis_no,
                             MAX(d.created_at) as siparis_tarih,
                             "" as konu, "" as marka, "" as teslimat_tipi, "" as kargo_no, "" as dolgu')
                ->groupBy('d.fis_no')
                ->orderByDesc(DB::raw('MAX(d.id)'))
                ->limit(500)
                ->get();
        }

        return response()->json($rows);
    }

    // DROPDOWN data (DB-backed + fixed lists)

    public function refData()
    {
        $q = DB::table('ordersdetay');

        $pluckDistinct = function ($col) use ($q) {
            return DB::table('ordersdetay')
                ->whereNotNull($col)
                ->where($col, '<>', '')
                ->distinct()
                ->orderBy($col)
                ->pluck($col)
                ->values();
        };

        return response()->json([
            'renk'           => $pluckDistinct('renk'),
            'sistem'         => $pluckDistinct('sistem'),
            'slayt'          => $pluckDistinct('slayt'),
            'camkalinlik'    => $pluckDistinct('ic_cam'),   // use ic_cam values as source
            'kasarenk'       => $pluckDistinct('kasa_renk'),
            'mekanizma_yon'  => ['SOL', 'SAĞ'],              // fixed list
            'cam'            => ['Var', 'Yok'],              // fixed list
        ]);
    }

    // STORE one line into ordersdetay (exact column names)
    public function store(Request $request)
    {
        // 1) Validate only what you already post
        $v = $request->validate([
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
        ]);

        // 2) Calculations (already your rule)
        $m2 = max($v['en'] * $v['boy'], 1);
        $tutarDoviz = $v['miktar'] * $m2 * $v['m2_fiyat'];

        // 3) Do both inserts atomically and reuse the same fis_no
        return DB::transaction(function () use ($v, $m2, $tutarDoviz) {
            // Choose the next fis_no (take the higher of both tables, avoid collisions)
            $maxOrders     = (int) (DB::table('orders')->max('fis_no') ?? 0);
            $maxOrdersDet  = (int) (DB::table('ordersdetay')->max('fis_no') ?? 0);
            $fisNo         = max($maxOrders, $maxOrdersDet) + 1;

            // --- a) Detail row (ordersdetay)
            DB::table('ordersdetay')->insert([
                'fis_no'         => $fisNo,
                'en'             => $v['en'],
                'boy'            => $v['boy'],
                'm2'             => round($m2, 2),
                'renk'           => $v['renk']          ?? null,
                'mekanizma_yon'  => $v['mekanizma_yon'] ?? null,
                'sistem'         => $v['sistem']        ?? null,
                'slayt'          => $v['slayt']         ?? null,
                'cam'            => $v['cam'],
                'ic_cam'         => $v['ic_cam']        ?? null,
                'dis_cam'        => $v['dis_cam']       ?? null,
                'm2_fiyat'       => $v['m2_fiyat'],
                'tutar_doviz'    => round($tutarDoviz, 2),
                'satir_tutar'    => round($tutarDoviz, 2),
                'tutar'          => round($tutarDoviz, 2),
                'aciklama'       => $v['aciklama']      ?? null,
                'poz'            => $v['poz']           ?? null,
                'kasa_renk'      => $v['kasa_renk']     ?? null,
                'alt_kasa_renk'  => $v['alt_kasa_renk'] ?? null,
                'cam_cita_renk'  => $v['cam_cita_renk'] ?? null,
                'miktar'         => $v['miktar'],
            ]);

            // The header total should reflect the sum of all lines of this fis_no
            $sum = (float) DB::table('ordersdetay')
                ->where('fis_no', $fisNo)
                ->sum('tutar_doviz');

            // --- b) Header row (orders): create it if it doesn't exist, otherwise update its total.
            $exists = DB::table('orders')->where('fis_no', $fisNo)->exists();

            if ($exists) {
                DB::table('orders')
                    ->where('fis_no', $fisNo)
                    ->update([
                        // keep using ONLY what we already have
                        'aciklama'           => $v['aciklama'] ?? DB::raw('aciklama'),
                        'teklif_doviz_tutar' => round($sum, 2),
                    ]);
            } else {
                DB::table('orders')->insert([
                    'fis_no'             => $fisNo,
                    // only fields we can fill from current request/derived data
                    'tarih'              => now()->toDateString(),
                    'aciklama'           => $v['aciklama'] ?? '',
                    'teklif_doviz_tutar' => round($sum, 2),
                    // everything else uses the table defaults (no extra inputs added)
                ]);
            }

            return response()->json([
                'ok'     => true,
                'fis_no' => $fisNo,
                'total'  => round($sum, 2),
            ], 201);
        });
    }


    public function show($fis)
    {
        $row = DB::table('orders')->where('fis_no', $fis)->first(); // or your real header table
        abort_if(!$row, 404);
        return response()->json($row);
    }

    public function update(Request $r, $fis)
    {
        $data = $r->validate([
            'tarih' => ['nullable', 'date'],
            'konu'  => ['nullable', 'string'],
            'marka' => ['nullable', 'string'],
            'teslimat_tipi' => ['nullable', 'string'],
            'kargo_no' => ['nullable', 'string'],
            'dolgu' => ['nullable', 'string'],
        ]);
        DB::table('orders')->where('fis_no', $fis)->update($data);
        return response()->json(['ok' => true]);
    }

    public function destroy($fis)
    {
        DB::table('orders')->where('fis_no', $fis)->delete();
        // If you also need to remove details:
        // DB::table('ordersdetay')->where('fis_no', $fis)->delete();
        return response()->json(['ok' => true]);
    }
}
