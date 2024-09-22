<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'main_category',
        'sub_category',
        'description',
        'contact_number',
        'permission'
    ];


    // Define the relationship with the Room model (based on room_id)
    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

}
