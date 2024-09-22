<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomsingle extends Model
{
    use HasFactory;
    protected $table = 'room_types';

    public $timestamps = false;
}
