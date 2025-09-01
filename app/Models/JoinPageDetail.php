<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinPageDetail extends Model
{
    use HasFactory;

    protected $table = 'join_us';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_image',
        'description_main',
        'why_dkt_description',
        'features',
        'section_heading',
        'section_title',
        'right_role_image',
        'right_role_description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

}
