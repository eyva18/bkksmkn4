<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaanModel extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pekerjaan';
    protected $guarded = ['id'];

    public function Pekerjaan() {
        return $this->belongsTo(JenisPekerjaanModel::class, 'jenis_pekerjaan', 'id');
    }

    public function Alumni() {
        return $this->belongsTo(Alumni::class);
    }
}
