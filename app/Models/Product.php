<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;

    protected $table = 'products';
    
    public function imports()
    {
        return $this->hasMany(Import::class);
    }
    public function exports()
    {
        return $this->hasMany(Export::class);
    }
}
