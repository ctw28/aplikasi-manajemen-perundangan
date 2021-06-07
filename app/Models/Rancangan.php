<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rancangan extends Model
{
    use HasFactory;
    protected $table = 'rancangans';
    protected $fillable = [
        'no_registrasi',
        'tgl_input',
        'tgl_rancangan',
        'no_surat',
        'kabupaten_id',
        'perihal',
        'status',
        'keterangan',
        'file_rancangan'
    ];

    public function getKabupatenById()
    {
        return $this->hasOne('App\Models\Kabupaten', 'id', 'kabupaten_id');
    }
}