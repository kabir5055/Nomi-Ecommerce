<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
    	$read = "All Product";
    	$lists = Product::with('category','subcategory')->oldest()->get();
    	return view('back-end.product.index',compact('lists','read'));
    }

    public function create(){
    	$create = "Create Product";

        $categories = Cache::remember('categories', 60, function () {
            return Category::oldest()->get();
        });

        $brands = Cache::remember('brands',60, function () {
            return Brand::oldest()->get();
        });

         $units = Cache::remember('units',60, function () {
            return Unit::oldest()->get();
        });

        $colors = Cache::remember('colors',60, function () {
            return Color::oldest()->get();
        });

        $sizes = Cache::remember('sizes', 60, function () {
            return Size::oldest()->get();
        });

    	return view('back-end.product.create',compact('create','categories','brands','units','colors','sizes'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'product_name' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'product_description' => 'required',
            'product_image' => 'required',
        ], [
            'category_id.required' => 'Category is required',
            'brand_id.required' => 'Brand is required',
            'unit_id.required' => 'Unit is required',
            'product_name.required' => 'Product name is required',
            'sale_price.required' => 'Sale price is required',
            'quantity.required' => 'Quantity is required',
            'product_description.required' => 'Product description is required',
            'product_image.required' => 'Product image is required',
        ]);
        
        
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->size = json_encode($request->size);
        $product->color = json_encode($request->color);
        $product->product_name = $request->product_name;
        $product->product_slug = Str::slug($request->product_name);
        $product->sale_price = $request->sale_price;
        $product->discount_type = $request->discount_type;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->product_description = $request->product_description;
         
        if($request->hasFile('product_image')){
            $file = $request->file('product_image');
            
            if($file->isValid()){
                $path = public_path('back-end/product/product/');
                $fileName = time() . '.webp';
                Image::make($file)
                    ->encode('webp', 75)
                    ->save($path . $fileName);
                $product->product_image = $fileName;
            } else {
                return redirect()->back()->withErrors('Invalid product image');
            }
        }
        
       
            $files = [];
            if($request->hasfile('product_gallery')){
                foreach($request->file('product_gallery') as $file){
                    if($file->isValid()){
                        $name = time() . rand(1,100) . '.webp';
                        $path = public_path('back-end/product/gallery/');
                        Image::make($file)
                            ->encode('webp', 75)
                            ->save($path . $name);
                        $files[] = $name;
                    } else {
                        return redirect()->back()->withErrors('Invalid gallery image');
                    }
                }
            }
            

        $product->product_gallery = json_encode($files);
        $product->save();

         Toastr::success('Data Saved Successfully', 'Success', ["positionClass" => "toast-top-right"]);
         return redirect()->back();
    }

    public function edit($id){
    	$edit = "Update Product";
        $info = Product::findOrFail($id);
        $categories =Category::oldest()->get();
        $brands = Brand::oldest()->get();
        $units = Unit::oldest()->get();
        $colors = Color::oldest()->get();
        $sizes = Size::oldest()->get();

    	return view('back-end.product.edit',compact('edit','info','categories','brands','units','colors','sizes'));
    }

   public function update(Request $request){
    // dd($request->all());
    
    $product = Product::findOrFail($request->id);
    $product->category_id = $request->category_id;
    $product->subcategory_id = $request->subcategory_id;
    $product->brand_id = $request->brand_id;
    $product->unit_id = $request->unit_id;

    if (is_array($request->size)) {
        $product->size = json_encode($request->size);
    } else {
        $product->size = $request->size;
    }

    if (is_array($request->color)) {
        $product->color = json_encode($request->color);
    } else {
        $product->color = $request->color;
    }

    $product->product_name = $request->product_name;
    $product->product_slug = Str::slug($request->product_name);
    $product->sale_price = $request->sale_price;
    $product->discount_type = $request->discount_type;
    $product->discount_price = $request->discount_price;
    $product->quantity = $request->quantity;
    $product->product_description = $request->product_description;

    if($request->hasFile('product_image')){
        $path = public_path('back-end/product/product/');
        if ($product->product_image && File::exists($path . $product->product_image)) {
            File::delete($path . $product->product_image);
        }
        
        $file = $request->product_image;
        $fileName = time() . '.webp';
        Image::make($file)
            ->encode('webp', 90)
            ->save($path . $fileName);
        $product->product_image = $fileName;
    }

    $files = [];

    if($product->product_gallery){
        $files = json_decode($product->product_gallery, true);
    }

    if($request->hasFile('product_gallery')){
        $galleryPath = public_path('back-end/product/gallery/');
        foreach($files as $oldGalleryImage) {
            if (File::exists($galleryPath . $oldGalleryImage)) {
                File::delete($galleryPath . $oldGalleryImage);
            }
        }

        $files = [];

        foreach($request->file('product_gallery') as $file){
            $name = time() . rand(1, 100) . '.webp';

            Image::make($file)
                ->encode('webp', 90)
                ->save($galleryPath . $name);

            $files[] = $name;
        }

        $product->product_gallery = json_encode($files);
    }

    $product->save();

    Toastr::success('Data Updated Successfully', 'Success', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
}


    public function delete($id) {
    $info = Product::findOrFail($id);

    if ($info) {
        // Delete the main product image
        $mainImagePath = public_path('back-end/product/product/' . $info->product_image);
        if (file_exists($mainImagePath)) {
            @unlink($mainImagePath);
        }

        // Delete gallery images
        $gallery = json_decode($info->product_gallery, true); // true to get array instead of object
        if ($gallery && is_array($gallery)) {
            foreach ($gallery as $galleryImage) {
                $galleryImagePath = public_path('back-end/product/gallery/' . $galleryImage);
                if (file_exists($galleryImagePath)) {
                    @unlink($galleryImagePath);
                }
            }
        }

        // Delete the product record from the database
        $info->delete();

        // Show a success message and redirect
        Toastr::success('Product Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('product.index');
    }

    // Show an error message if the product was not found
    Toastr::error('Product Not Found', '', ["positionClass" => "toast-top-right"]);
    return redirect()->route('product.index');
}

    public function duplicate($id){
         $info = Product::findOrfail($id);
         $new_apon = $info->replicate();
         $new_apon->save();
         Toastr::success('Product duplicate Successful', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

    public function deleteGalleryImage($id, $index){
    $product = Product::find($id);
    if ($product) {
        $gallery = json_decode($product->product_gallery);
        if (isset($gallery[$index])) {
            // Remove the image file from the server
            $imagePath = public_path('back-end/product/gallery/' . $gallery[$index]);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Remove the image from the array and re-encode it
            unset($gallery[$index]);
            $gallery = array_values($gallery); // Re-index the array
            $product->product_gallery = json_encode($gallery);
            $product->save();
        }
    }

    return redirect()->back()->with('success', 'Image deleted successfully');
}

    public function inactive($id){
        $info = Product::find($id);
        $info->status=0;
        $info->save();
        Toastr::success('Product Inactive Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

     public function active($id){
        $info = Product::find($id);
        $info->status=1;
        $info->save();
        Toastr::success('Product Active Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

    public function nofeatured($id){
        $info = Product::find($id);
        $info->is_featured=0;
        $info->save();
        Toastr::success('Product Featured Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

     public function featured($id){
        $info = Product::find($id);
        $info->is_featured=1;
        $info->save();
        Toastr::success('Product Featured Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

     public function todays_deal_inactive($id){
        $info = Product::find($id);
        $info->is_todays_deal=0;
        $info->save();
        Toastr::success('Product Todays Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

     public function todays_deal_active($id){
        $info = Product::find($id);
        $info->is_todays_deal=1;
        $info->save();
        Toastr::success('Product Todays Successfully', '', ["positionClass" => "toast-top-right"]);
         return redirect()->route('product.index');
    }

}
