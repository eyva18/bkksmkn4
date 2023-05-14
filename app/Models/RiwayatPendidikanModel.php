<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikanModel extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pendidikan';
    protected $guarded = ['id'];

    public function JenisPendidikan() {
        return $this->belongsTo(JenisPendidikanModel::class);
    }

    public function Alumni() {
        return $this->belongsTo(Alumni::class);
    }
}
