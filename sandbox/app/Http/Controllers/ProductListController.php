<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class ProductListController extends Controller
{
    
    public function index(Request $request){
        // $product_lists = ProductList::all();
        
        $productsort = 'id|asc';
        // //デフォルトはidの昇順（asc）を設定
        if (!is_null($request->productsort)) {
            $productsort = $request->productsort;
        }
        $sort_explode = explode('|', $productsort);

        $append_param = [];

        //カテゴリーでの絞り込み　ソート設定
        $category_s = '';
        if(!is_null($request->category_s)){
            $category_s = $request->category_s;
            $product_lists = ProductList::withWhereHas('category', function ($query) use ($sort_explode,$category_s) {
                $query->where('id', $category_s);
            })->orderBy($sort_explode[0], $sort_explode[1])->paginate(10);
        }else{
            $product_lists = ProductList::withWhereHas('category', function ($query) use($sort_explode) {
                $query->where('', '');
            })->orderBy($sort_explode[0], $sort_explode[1])->paginate(10);
        }

        $append_param['category_s'] = $category_s;
        $append_param['productsort'] = $productsort;

        
        $categories = Category::all();
        $product_lists->appends($append_param); 
        return view('product_lists.index', compact('product_lists','categories', 'category_s', 'productsort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $product_name = $request->input('product_name');
        // dd($product_name);

        $rules = [
            'product_name' => 'required|max:100',
            'product_price' => 'required|integer',
            'product_category' => 'required',
          ];
         
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。', 'integer' => '整数を入力してください'];
         
        Validator::make($request->all(), $rules, $messages)->validate();
          
        //モデルをインスタンス化
        $product = new ProductList;
        
        //モデル->カラム名 = 値 で、データを割り当てる
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->category_id = $request->input('product_category');


        //データベースに保存
        $product->save();
        
        //リダイレクト
        return redirect('/lists');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product= ProductList::find($id);
        $categories = Category::all();
        return view('product_lists.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rules = [
            'product_name' => 'required|max:100',
            'product_price' => 'required|integer',
            'product_category' => 'required',
          ];
         
        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。', 'integer' => '整数を入力してください'];
         
        Validator::make($request->all(), $rules, $messages)->validate();
          
        //モデルをインスタンス化
        $product = ProductList::find($id);
        
        //モデル->カラム名 = 値 で、データを割り当てる
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->category_id = $request->input('product_category');


        //データベースに保存
        $product->save();
        
        //リダイレクト
        return redirect('/lists');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        //ProductList::find($id)->delete();

        // 該当するレコードをproduct_listsテーブルから論理削除
        ProductList::find($id)->update(['deleted_at' => now()]);
  
        return redirect('/lists');
    }
}
