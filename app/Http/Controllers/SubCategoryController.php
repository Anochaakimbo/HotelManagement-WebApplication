<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function getSubCategories($mainCategoryId)
    {
        $subCategories = SubCategory::where('main_category_id', $mainCategoryId)->get();
        return response()->json($subCategories);
    }

}
