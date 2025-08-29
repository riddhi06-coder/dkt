<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    protected $table = 'contact_details';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'map_url',
        'contact_number',
        'other_contact_number',
        'i_frame',
        'address',
        'social_media_links',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
