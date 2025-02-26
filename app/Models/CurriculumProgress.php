<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $fillable = ['curriculum_id', 'user_id', 'clear_flg'];

    protected $table = 'curriculum_progress';

    public function progress()
    {
        return $this->hasMany(Curriculum::class, 'curriculums_id');
    }
}

