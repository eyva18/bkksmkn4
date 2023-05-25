<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatPerlombaanModel extends Model
{
    use HasFactory;
    protected $table = 'tingkat_perlombaan';
    protected $guarded = ['id'];
}
