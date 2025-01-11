<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    // CurriculumProgressモデル
    protected $table = 'curriculum_progress';

    protected $fillable = [
        'curriculums_id', 
        'users_id', 
        'clear_flg
        '];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
