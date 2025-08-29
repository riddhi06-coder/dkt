<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';
    public $timestamps = false;

    protected $fillable = [
        'category_name',
        'slug',
        'thumbnail_image',
        'description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }

    public function productsDetails()
    {
        return $this->hasMany(ProductDetails::class, 'category_id', 'id');
    }

    public function details()
    {
        return $this->hasOne(CategoryDetails::class, 'category_id', 'id')
                    ->whereNull('deleted_by'); // only active details
    }


}
