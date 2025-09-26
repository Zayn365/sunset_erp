<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OfferController extends Controller
{
    /** Offer list page */
    public function index()
    {
        return view('admin.offer'); // resources/views/offer.blade.php
    }

    /** JSON for your table/grid */
    public function data()
    {
        // pick a tidy subset for the grid, but don't crash if some columns are missing
        $cols = Schema::getColumnListing('teklif');

        $select = array_values(array_intersect($cols, [
            'id',
            'fis_no',
            'tarih',
            'konu',
            'marka',
            'teslimat_tipi',
            'teklif_doviz_tutar',
            'teklif_tl_tutar',
            'genel_iskonto',
            'dolgu'
        ])) ?: ['*'];

        $rows = DB::table('teklif')
            // ->select($select)
            ->orderBy('fis_no', 'desc')
            ->limit(500)
            ->get();

        return response()->json($rows);
    }

    /** Create a header row in teklif */
    public function store(Request $request)
    {
        // validate only header-ish fields that are known to exist on your schema
        $v = $request->validate([
            'fis_no'         => ['nullable', 'integer', 'min:1'],
            'tarih'          => ['nullable', 'date'],
            'konu'           => ['nullable', 'string'],
            'marka'          => ['nullable', 'string'],
            'teslimat_tipi'  => ['nullable', 'string'],
            'aciklama'       => ['nullable', 'string'],
            'cari_kod'       => ['nullable', 'string'],
            'teklif_doviz'   => ['nullable', 'string', 'max:5'],
            'teklif_kur'     => ['nullable', 'numeric'],
            'genel_iskonto'  => ['nullable', 'numeric'],
            'dolgu'          => ['nullable', 'string'],
        ]);

        $fisNo = $v['fis_no'] ?? $this->nextFisNo();

        // Build insert payload from real columns only
        $cols  = Schema::getColumnListing('teklif');
        $today = now()->toDateString();

        $data = array_filter([
            'fis_no'            => $fisNo,
            'tarih'             => $v['tarih'] ?? (in_array('tarih', $cols) ? $today : null),
            'konu'              => $v['konu'] ?? null,
            'marka'             => $v['marka'] ?? null,
            'teslimat_tipi'     => $v['teslimat_tipi'] ?? null,
            'aciklama'          => $v['aciklama'] ?? null,
            'cari_kod'          => $v['cari_kod'] ?? null,
            'teklif_doviz'      => $v['teklif_doviz'] ?? 'TL',
            'teklif_kur'        => $v['teklif_kur'] ?? 1,
            'genel_iskonto'     => $v['genel_iskonto'] ?? 0,
            'dolgu'             => $v['dolgu'] ?? '',
            // if present in your table these will be accepted; otherwise ignored by array_intersect below
            'teklif_doviz_tutar' => 0,
            'teklif_tl_tutar'   => 0,
        ], fn($x) => $x !== null);

        // Strip anything that isn't a real column
        $data = array_intersect_key($data, array_flip($cols));

        DB::table('teklif')->insert($data);

        return response()->json([
            'ok'     => true,
            'fis_no' => $fisNo,
            'id'     => (int) DB::getPdo()->lastInsertId(),
        ], 201);
    }

    /** Read one header */
    public function show($id)
    {
        $row = DB::table('teklif')->where('id', $id)->first();
        abort_if(!$row, 404);
        return response()->json($row);
    }

    /** Update header */
    public function update(Request $request, $id)
    {
        $row = DB::table('teklif')->where('id', $id)->first();
        abort_if(!$row, 404);

        $v = $request->validate([
            'tarih'          => ['nullable', 'date'],
            'konu'           => ['nullable', 'string'],
            'marka'          => ['nullable', 'string'],
            'teslimat_tipi'  => ['nullable', 'string'],
            'aciklama'       => ['nullable', 'string'],
            'cari_kod'       => ['nullable', 'string'],
            'teklif_doviz'   => ['nullable', 'string', 'max:5'],
            'teklif_kur'     => ['nullable', 'numeric'],
            'genel_iskonto'  => ['nullable', 'numeric'],
            'dolgu'          => ['nullable', 'string'],
            // add other header fields if you need them
        ]);

        $cols = Schema::getColumnListing('teklif');
        $upd  = array_intersect_key($v, array_flip($cols));
        if (empty($upd)) {
            return response()->json(['ok' => true]); // nothing to update
        }

        DB::table('teklif')->where('id', $id)->update($upd);

        return response()->json(['ok' => true]);
    }

    /** Delete header */
    public function destroy($id)
    {
        $exists = DB::table('teklif')->where('id', $id)->exists();
        abort_if(!$exists, 404);

        DB::table('teklif')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }

    /** Helpers */

    public function options()
    {
        // Whitelist each dropdown and which table/columns it maps to.
        // Change column names if your schema differs (e.g. name/ad/title).
        $maps = [
            'sistem'            => ['table' => 'sistem',     'id' => 'id', 'text' => 'kod'],
            'renk'              => ['table' => 'renk',       'id' => 'id', 'text' => 'kod'],
            'slayt'             => ['table' => 'slayt',      'id' => 'id', 'text' => 'kod'],
            'camkalinlik'       => ['table' => 'camkalinlik', 'id' => 'id', 'text' => 'kod'],
            'kasarenk'          => ['table' => 'kasarenk',   'id' => 'id', 'text' => 'kod'],
        ];

        $out = [];
        foreach ($maps as $key => $m) {
            if (!Schema::hasTable($m['table'])) {
                $out[$key] = [];
                continue;
            }
            $rows = DB::table($m['table'])
                ->when(Schema::hasColumn($m['table'], $m['text']), function ($q) use ($m) {
                    $q->orderBy($m['text']);
                })
                ->get([$m['id'] . ' as id', $m['text'] . ' as text']);
            $out[$key] = $rows;
        }

        // Fixed-value dropdowns
        $out['mekanizma_yon'] = [
            ['id' => 'SOL', 'text' => 'SOL'],
            ['id' => 'SAĞ', 'text' => 'SAĞ'],
        ];
        $out['cam_var_yok'] = [
            ['id' => 'Var', 'text' => 'Var'],
            ['id' => 'Yok', 'text' => 'Yok'],
        ];

        return response()->json($out);
    }
    // App/Http/Controllers/OfferController.php

    protected function nextFisNo(): int
    {
        return (int) (DB::table('teklif')->max('fis_no') ?? 0) + 1;
    }
    public function nextFis()
    {
        return response()->json(['next_fis_no' => $this->nextFisNo()]);
    }
}
