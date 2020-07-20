<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable=['name','created_by','updated_by','description','category','image','price'];


    public function author(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function editor(){
        return $this->belongsTo(User::class,'updated_by');
    }
    public function image(){
        return asset('uploads/products/'.$this->image.'.jpg');
    }
    public function rate(){
        $rate=Rate::where('name','USD')->first();
        return round($this->price*$rate->rate,2);
    }
}
