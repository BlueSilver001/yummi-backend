<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','created_by','updated_by'];


    public function author(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function editor(){
        return $this->belongsTo(User::class,'updated_by');

    }
}
