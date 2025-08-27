<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeIntro extends Model
{
    use HasFactory;

    protected $table = 'home_intro';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'results_image',
        'description',
        'gallery_images',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
