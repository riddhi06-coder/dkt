<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSocial extends Model
{
    use HasFactory;

    protected $table = 'home_social';
    public $timestamps = false;

    protected $fillable = [
        'section_title',
        'heading',
        'title',
        'image',
        'banner_video',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
