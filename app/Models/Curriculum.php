<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    use HasFactory;

    protected $table ='curriculums';
    // 複数形/単数形に該当しない命名の時は「protected $table ='テーブル名」で設定可

    protected $fillable = [
        'title',
        'thumbnail',
        'description', 
        'video_url', 
        'always_delivery_flg',
        'grade_id'
    ];

    public function getCurriculums(){
        $curriculums = DB::table('curriculums')->get();
        return $curriculums;
    }
    

    public function isAvailable()
    {
        $now = now();
        return $this->available_from <= $now && $this->available_to >= $now;
    }
}
