<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = [
        'no_perda',
        'tgl_input',
        'tgl_produk',
        'tahun',
        'kabupaten_id',
        'jenis_produk',
        'status',
        'file_produk'
    ];

    public function getKabupatenById()
    {
        return $this->hasOne('App\Models\Kabupaten', 'id', 'kabupaten_id');
    }
}