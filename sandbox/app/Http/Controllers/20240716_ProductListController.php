<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;

class ProductListController extends Controller
{
    public function index(Request $request){
        $product_lists = ProductList::all();
 
        // return view('product_lists.index', ['product_lists', $product_lists]);
        return view('product_lists.index', compact('product_lists'));
    }
}
