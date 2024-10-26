<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

     public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

     public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

     public function subcategory(){
    	return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }

    public function orderDetails(){
    	return $this->hasMany(OrderDetails::class,'product_id','id');
    }

}
