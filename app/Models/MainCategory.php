<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = ['name'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
