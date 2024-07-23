<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        //return view('product_lists.index', ['categories', $categories]);
        return view('product_lists.index', compact('categories'));
    }
}
