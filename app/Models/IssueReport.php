<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'issue', 'created_at', 'updated_at'];

    // Define relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

