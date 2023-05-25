<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPendidikanModel extends Model
{
    use HasFactory;
    protected $table = 'status_pendidikan';
    protected $guarded = ['id'];
}
