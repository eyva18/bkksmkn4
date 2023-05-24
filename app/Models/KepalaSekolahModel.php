<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaSekolahModel extends Model
{
    use HasFactory;
    protected $table = 'kepala_sekolah';
    protected $guarded = ['id'];
    public function jenis_kelamin()
    {
        return $this->belongsTo(JenisKelaminModel::class, 'jenis_kelamin', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
