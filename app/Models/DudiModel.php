<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DudiModel extends Model
{
    use HasFactory;
    protected $table = 'dudi';
    protected $fillable = ['id','nama', 'bidang', 'no_telp', 'deskripsi', 'alamat', 'logo', 'user_id'];
    public function userdata()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
}
