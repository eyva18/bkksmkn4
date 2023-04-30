<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganModel extends Model
{
    use HasFactory;
    protected $table = 'lowongan';
    protected $guarded = ['id'];
    public function dudi()
    {
        return $this->belongsTo(DudiModel::class, 'id_dudi', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(CategoryModel::class, 'id_kategoti_pekerjaan', 'id');
    }
}
