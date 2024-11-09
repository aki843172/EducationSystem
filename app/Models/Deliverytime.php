<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverytime extends Model
{
    use HasFactory;

    // protected $table ='delivery_times';
    
    protected $fillable = [
        'delivery_from',
        'delivery_to',
    ];

    public function getDeliverytimes(){
        $deliverytimes = DB::table('delivery_times')->get();
        return $deliverytimes;
    }


}
