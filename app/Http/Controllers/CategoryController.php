<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function NewMainCategory(Request $request)
    {
        $newMainCategory= $request->input('NewCategory');
        $newCategory = new Category();
        $newCategory->name = $newMainCategory;
        $newCategory->parent_id = 0;
        $newCategory->save();
        return view('index');
    }
}