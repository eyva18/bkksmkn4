<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikasiLombaModel extends Model
{
    use HasFactory;
    protected $table = 'sertifikasi_lomba';
    protected $guarded = ['id'];

    public function TingkatPerlombaan() {
        return $this->belongsTo(TingkatPerlombaanModel::class, 'tingkat_perlombaan', 'id');
    }
}
