<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPartner extends Model
{
    use HasFactory;

    protected $table = 'doctor_partner';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner',
        'description',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
