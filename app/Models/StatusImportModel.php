<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusImportModel extends Model
{
    use HasFactory;
    protected $table = 'status_import';
    protected $guarded = ['id'];
}
