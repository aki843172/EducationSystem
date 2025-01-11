<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // タイムスタンプを自動設定
    public $timestamps = true;

    // カリキュラムとのリレーション
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'grade_id');
    }

    // 学年順に取得するスコープ
    public function scopeOrderByGrade($query)
    {
        return $query->orderBy('id', 'asc');
    }

    // 学年レベルを文字列で返すメソッド
    public function getGradeLevel()
    {
        if ($this->id <= 6) {
            return '小学校';
        } elseif ($this->id <= 9) {
            return '中学校';
        } else {
            return '高校';
        }
    }

    // 学年の表示名を整形して返すメソッド
    public function getFormattedNameAttribute()
    {
        return "{$this->grade_level}{$this->name}";
    }

}
