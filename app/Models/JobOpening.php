<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    public $timestamps = false;

    protected $fillable = [
        'job_role',
        'job_location',
        'description_main',
        'job_pdf',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
