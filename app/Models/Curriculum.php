<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description', 
        'video_url', 
        'available_from', 
        'available_to'
        ];

    public function isAvailable()
    {
        $now = now();
        return $this->available_from <= $now && $this->available_to >= $now;
    }
}
