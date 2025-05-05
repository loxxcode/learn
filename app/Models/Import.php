<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = "imports";

    public function products(){
        return $this->belongsTo(Product::class,"product_id");
    }
    public function exports()
    {
        return $this->hasMany(Export::class);
    }
}
