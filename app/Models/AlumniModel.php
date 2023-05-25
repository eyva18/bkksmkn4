<?php

namespace App\Models;

use app\Http\Controllers\ControllersAdmin\AdminLaporanTahunKelulusanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniModel extends Model
{
    use HasFactory;
    protected $table = 'alumni';
    protected $guarded = ['id'];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'kode_jurusanId', 'id');
    }
    
    public function tahunlulus()
    {
        return $this->belongsTo(TahunLulusModel::class, 'kode_lulusId', 'id');
    }

    public function Agama() {
        return $this->belongsTo(AgamaModel::class, 'agamaId', 'id');
    }

    public function Jenis_Kelamin() {
        return $this->belongsTo(JenisKelaminModel::class, 'jenis_kelaminId', 'id');
    }

    public function Laporan_Kelulusan() {
        return $this->belongsTo(AdminLaporanTahunKelulusanController::class);
    }

    public function StatusBekerja() {
        return $this->belongsTo(StatusBekerjaModel::class, 'status_bekerja', 'id');
    }

    public function StatusPendidikan() {
        return $this->belongsTo(StatusPendidikanModel::class, 'status_pendidikan', 'id');
    }
}
