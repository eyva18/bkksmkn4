<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAlumniModel extends Model
{
    use HasFactory;
    protected $table = 'status_alumni';
    protected $guarded = ['id'];

    public function Jurusan() {
        return $this->belongsTo(JurusanModel::class, 'kode_jurusanId', 'id');
    }

    public function StatusBekerja() {
        return $this->belongsTo(StatusBekerjaModel::class, 'status_bekerja', 'id');
    }

    public function StatusPendidikan() {
        return $this->belongsTo(StatusPendidikanModel::class, 'status_pendidikan', 'id');
    }
}
