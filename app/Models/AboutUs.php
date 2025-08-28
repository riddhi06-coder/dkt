<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner',
        'gallery_images',
        'section1_description',
        'section2_description',
        'section3_description',
        'section_image',
        'section_image1',
        'division_details',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

}
