<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupatens';
    protected $fillable = [
        'kabupaten_kode',
        'kabupaten_nama'
    ];
}
