<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /** Page */
    public function index()
    {
        return view('user'); // resources/views/user.blade.php
    }

    /** List (optionally filter by q on kod/ad/soyad/bolum) */
    public function data(Request $request)
    {
        if (!DB::getSchemaBuilder()->hasTable('user')) {
            return response()->json([]);
        }

        $q = trim($request->get('q', ''));
        $rows = DB::table('user')
            ->when($q !== '', function ($sql) use ($q) {
                $like = '%' . $q . '%';
                $sql->where(function ($w) use ($like) {
                    $w->where('kod', 'like', $like)
                        ->orWhere('ad', 'like', $like)
                        ->orWhere('soyad', 'like', $like)
                        ->orWhere('bolum', 'like', $like);
                });
            })
            ->orderBy('id', 'desc')
            ->limit(500)
            ->get();

        return response()->json($rows);
    }

    /** Create */
    public function store(Request $request)
    {
        $v = $request->validate([
            'kod'                    => ['required', 'string', 'max:45'],
            'ad'                     => ['required', 'string', 'max:45'],
            'soyad'                  => ['nullable', 'string', 'max:45'],
            'bolum'                  => ['nullable', 'string', 'max:45'],
            'sifre'                  => ['nullable', 'string', 'max:45'],
            'unvan'                  => ['nullable', 'string', 'max:80'],
            'mail'                   => ['nullable', 'email', 'max:45'],
            'mail_user'              => ['nullable', 'string', 'max:45'],
            'mail_sifre'             => ['nullable', 'string', 'max:15'],
            'smtp_adres'             => ['nullable', 'string', 'max:25'],
            'tabloRenk1'             => ['nullable', 'string', 'max:20'],
            'tabloRenk2'             => ['nullable', 'string', 'max:20'],
            'alisFiyatGormeDurum'    => ['nullable', 'integer', 'min:0', 'max:1'],
            'order_satir_liste_tip'  => ['nullable', 'integer', 'min:0'],
            'mail_port'              => ['nullable', 'string', 'max:5'],
            'kullanici_tip'          => ['nullable', 'string', 'max:45'],
            'satisFiyatGormeDurum'   => ['nullable', 'integer', 'min:0', 'max:1'],
            'siparis_onayla'         => ['nullable', 'integer', 'min:0', 'max:1'],
            'bayi'                   => ['nullable', 'integer', 'min:0', 'max:1'],
            'bayi_kod'               => ['nullable', 'string', 'max:60'],
            'gunluk_hedef'           => ['nullable', 'numeric'],
        ]);

        $id = DB::table('user')->insertGetId($v);

        return response()->json([
            'ok' => true,
            'id' => $id,
            'row' => DB::table('user')->where('id', $id)->first(),
        ], 201);
    }

    /** Read one */
    public function show($id)
    {
        $row = DB::table('user')->where('id', $id)->first();
        abort_if(!$row, 404);
        return response()->json($row);
    }

    /** Update */
    public function update(Request $request, $id)
    {
        $row = DB::table('user')->where('id', $id)->first();
        abort_if(!$row, 404);

        $v = $request->validate([
            'kod'                    => ['sometimes', 'string', 'max:45'],
            'ad'                     => ['sometimes', 'string', 'max:45'],
            'soyad'                  => ['sometimes', 'nullable', 'string', 'max:45'],
            'bolum'                  => ['sometimes', 'nullable', 'string', 'max:45'],
            'sifre'                  => ['sometimes', 'nullable', 'string', 'max:45'],
            'unvan'                  => ['sometimes', 'nullable', 'string', 'max:80'],
            'mail'                   => ['sometimes', 'nullable', 'email', 'max:45'],
            'mail_user'              => ['sometimes', 'nullable', 'string', 'max:45'],
            'mail_sifre'             => ['sometimes', 'nullable', 'string', 'max:15'],
            'smtp_adres'             => ['sometimes', 'nullable', 'string', 'max:25'],
            'tabloRenk1'             => ['sometimes', 'nullable', 'string', 'max:20'],
            'tabloRenk2'             => ['sometimes', 'nullable', 'string', 'max:20'],
            'alisFiyatGormeDurum'    => ['sometimes', 'nullable', 'integer', 'min:0', 'max:1'],
            'order_satir_liste_tip'  => ['sometimes', 'nullable', 'integer', 'min:0'],
            'mail_port'              => ['sometimes', 'nullable', 'string', 'max:5'],
            'kullanici_tip'          => ['sometimes', 'nullable', 'string', 'max:45'],
            'satisFiyatGormeDurum'   => ['sometimes', 'nullable', 'integer', 'min:0', 'max:1'],
            'siparis_onayla'         => ['sometimes', 'nullable', 'integer', 'min:0', 'max:1'],
            'bayi'                   => ['sometimes', 'nullable', 'integer', 'min:0', 'max:1'],
            'bayi_kod'               => ['sometimes', 'nullable', 'string', 'max:60'],
            'gunluk_hedef'           => ['sometimes', 'nullable', 'numeric'],
        ]);

        if (!empty($v)) {
            DB::table('user')->where('id', $id)->update($v);
        }

        return response()->json([
            'ok'  => true,
            'row' => DB::table('user')->where('id', $id)->first(),
        ]);
    }

    /** Delete */
    public function destroy($id)
    {
        $exists = DB::table('user')->where('id', $id)->exists();
        abort_if(!$exists, 404);

        DB::table('user')->where('id', $id)->delete();

        return response()->json(['ok' => true]);
    }
}
