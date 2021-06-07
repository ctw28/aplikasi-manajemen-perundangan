<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('kabupatens')->insert([
            ['kabupaten_kode' => '7401', 'kabupaten_nama' => 'KABUPATEN BUTON'],
            ['kabupaten_kode' => '7402', 'kabupaten_nama' => 'KABUPATEN MUNA'],
            ['kabupaten_kode' => '7403', 'kabupaten_nama' => 'KABUPATEN KONAWE'],
            ['kabupaten_kode' => '7404', 'kabupaten_nama' => 'KABUPATEN KOLAKA'],
            ['kabupaten_kode' => '7405', 'kabupaten_nama' => 'KABUPATEN KONAWE SELATAN'],
            ['kabupaten_kode' => '7406', 'kabupaten_nama' => 'KABUPATEN BOMBANA'],
            ['kabupaten_kode' => '7407', 'kabupaten_nama' => 'KABUPATEN WAKATOBI'],
            ['kabupaten_kode' => '7408', 'kabupaten_nama' => 'KABUPATEN KOLAKA UTARA'],
            ['kabupaten_kode' => '7409', 'kabupaten_nama' => 'KABUPATEN BUTON UTARA'],
            ['kabupaten_kode' => '7410', 'kabupaten_nama' => 'KABUPATEN KONAWE UTARA'],
            ['kabupaten_kode' => '7411', 'kabupaten_nama' => 'KABUPATEN KOLAKA TIMUR'],
            ['kabupaten_kode' => '7412', 'kabupaten_nama' => 'KABUPATEN KONAWE KEPULAUAN'],
            ['kabupaten_kode' => '7413', 'kabupaten_nama' => 'KABUPATEN MUNA BARAT'],
            ['kabupaten_kode' => '7414', 'kabupaten_nama' => 'KABUPATEN BUTON TENGAH'],
            ['kabupaten_kode' => '7415', 'kabupaten_nama' => 'KABUPATEN BUTON SELATAN'],
            ['kabupaten_kode' => '7471', 'kabupaten_nama' => 'KOTA KENDARI'],
            ['kabupaten_kode' => '7472', 'kabupaten_nama' => 'KOTA BAUBAU']
        ]);
    }
}
