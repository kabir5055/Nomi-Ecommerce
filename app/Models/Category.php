<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['cat_name','cat_slug','status'];

    public function categoryCount(){
    	return $this->hasMany(Subcategory::class,'category_id','id');
    }

    public function categoryProduct(){
    	return $this->hasMany(Product::class,'category_id','id');
    }
}
