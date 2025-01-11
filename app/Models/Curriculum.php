<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
       
        protected $table = 'curriculums';
        
        protected $fillable = [
            'title',           // カリキュラムタイトル
            'thumbnail',       // サムネイル画像のパス
            'description',     // カリキュラムの説明文
            'video_url',       // 動画のURL
            'always_delivery_flg', // 常時公開フラグ
            'grade_id'        // クラスID
        ];

       
        // app/Models/Curriculum.php
        protected $casts = [
            'always_delivery_flg' => 'integer', // booleanではなくintegerに変更
];

        // 配信時間との関連付け
        public function deliveryTimes()
        {
            return $this->hasMany(DeliveryTime::class, 'curriculums_id');
        }
    
        // ユーザーの進捗状況との関連付け
        public function curriculumProgress()
        {
            return $this->hasMany(CurriculumProgress::class, 'curriculums_id');
        }
    
        // クラス（学年）との関連付け
        public function grade()
        {
            return $this->belongsTo(Grade::class, 'grade_id');
        }
    
        // サムネイル画像のフルパスを取得
        public function getThumbnailUrlAttribute()
        {
            return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
        }

}
