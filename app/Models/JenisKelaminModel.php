<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelaminModel extends Model
{
    use HasFactory;
    protected $table = 'jenis_kelamin';
    protected $guarded = ['id'];

    public function Alumni() {
        return $this->belongsTo(AlumniModel::class);
    }
}
