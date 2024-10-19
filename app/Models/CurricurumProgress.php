<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricurumProgress extends Model
{
    use HasFactory;

    protected $fillable = ['curriculum_id', 'user_id', 'clear_flg'];
}
