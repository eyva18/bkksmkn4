<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPekerjaanModel extends Model
{
    use HasFactory;
    protected $table = 'jenis_pekerjaan';
    protected $guarded =  ['id'];

    public function RiwayatPendidikan() {
        return $this->belongsTo(RiwayatPendidikanModel::class);
    }
}
