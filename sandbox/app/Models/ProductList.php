<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','price','category_id','deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }
}
