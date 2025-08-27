<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $table = 'product_details';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'product_id',
        'thumbnail_image',
        'product_image',
        'buy_now',
        'description',
        'use_of_tablet',
        'direction_to_use',
        'composition',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
