<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = "exports";
    public function products(){
        return $this->belongsTo(Product::class, "product_id");
    }
    public function imports(){
        return $this->belongsTo(Import::class,"import_id");
    }
}
