<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'room',
        'main_category',
        'sub_category',
        'description',
        'contact_number',
        'permission',
    ];

}

