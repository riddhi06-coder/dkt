<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_name',
        'slug',
        'thumbnail_image',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\ProductCategory::class, 'category_id');
    }

    public function details()
    {
        return $this->hasOne(CategoryDetails::class, 'category_id', 'category_id')
                    ->whereNull('deleted_by'); // only active details
    }

}
