<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaanModel extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pendidikan';
    protected $guarded = ['id'];
}
