<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $fillable = ['name'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class); // สัมพันธ์แบบ one-to-many
    }
}
