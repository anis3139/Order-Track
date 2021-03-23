<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'users_id',
        'brand_id',
        'category_id',
        'vendor_id',
    ];

    public function category() {
         return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function vendor() {
         return $this->hasMany(Vendor::class, 'id', 'vendor_id');
    }
    public function brand() {
         return $this->hasMany(Brand::class, 'id', 'brand_id');
    }
   
}
