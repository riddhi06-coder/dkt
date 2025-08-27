<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    use HasFactory;

    protected $table = 'home_banner';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_title',
        'thumbnail',
        'banner_video',
        'description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
