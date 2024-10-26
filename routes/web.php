<?php

use Illuminate\Support\Facades\Route;


 // Route::get('/products','App\Http\Controllers\FrontEnd\FrontEndController@fetchProducts')->name('fetchProducts');

 

/* front end */
Route::group(['as'=>'front.','namespace'=>"App\Http\Controllers\FrontEnd"],function(){
    Route::get('/user/login','UserController@login')->name('user.login');
    Route::post('/user/login/store','UserController@login_store')->name('user.login.store');
    Route::get('/user/register','UserController@register')->name('user.register');
    Route::post('/user/register/store','UserController@register_store')->name('user.register.store');
});

Route::group(['middleware'=>'frontend'],function(){

 Route::group(['as'=>'front.','namespace'=>"App\Http\Controllers\FrontEnd"],function(){
     Route::get('/','FrontEndController@home')->name('home');
     Route::get('/categories','FrontEndController@categories')->name('categories');
     Route::get('/subcategories','FrontEndController@subcategories')->name('subcategories');
     Route::get('/brands','FrontEndController@brands')->name('brands');
      Route::get('/shop','FrontEndController@shop')->name('shop');
     Route::get('/products/{product_slug}','FrontEndController@details')->name('details');
     Route::get('/product/search','FrontEndController@search')->name('search');
     Route::get('/product/cart','FrontEndController@cart')->name('cart');
     

     Route::get('/user/profile','UserController@update_view')->name('user.profile.update');
     Route::post('/user/profile/update','UserController@profile_update')->name('user.profile.update.store');

     Route::get('/user/logout','UserController@logout')->name('user.logout');

     Route::get('/user/dashboard','FrontEndController@user_dashbaord')->name('user.dashboard');

     Route::get('/user/change/password','UserController@change_password')->name('user.change.password');
     Route::post('/user/change/password/store','UserController@change_password_store')->name('user.change.password.store');
    
     Route::get('/purchase/history','PurchaseController@purchaseHistory')->name('purchase.history');
     Route::get('/purchase/history/details/{id}','PurchaseController@purchaseHistoryDetails')->name('purchase.history.details');

     Route::get('/category/products/{cat_slug}','FrontEndController@category_products')->name('category.products');
     Route::get('/subcategory/products/{subcat_slug}','FrontEndController@subcategory_products')->name('subcategory.products');

     Route::get('/brand/products/{brand_slug}','FrontEndController@brand_products')->name('brand.products');
     //search product
     Route::post('/search/products','FrontEndController@search_products')->name('search.products');
     Route::post('/search/suggest','FrontEndController@searchSuggest')->name('search.suggest');
     //cart product
     Route::post('/products/cart','CartController@products_cart')->name('products.cart');
     Route::post('/products/buy','CartController@buy_now')->name('products.buy.now');
     Route::get('/products/cart/delete/{id}','CartController@product_cart_delete')->name('product.cart.delete');

     Route::post('/products/cart/update','CartController@product_cart_update')->name('product.cart.update');

     Route::post('/apply/coupon','CartController@applyCoupon')->name('apply.coupon');

     Route::post('/shipping/address/create','ShippingAddressController@create')->name('shipping.address.create');
     Route::post('/shipping/address','ShippingAddressController@store')->name('shipping.address.store');

     Route::get('/get-districts/{division_id}', 'ShippingAddressController@getDistricts')->name('get-districts');
     Route::get('/get-thanas/{district_id}', 'ShippingAddressController@getThanas')->name('get-thanas');
     Route::get('/get-unions/{thana_id}', 'ShippingAddressController@getUnions')->name('get-unions');

     Route::get('/payment','PaymentController@payment_create')->name('payment');
     Route::post('/payment/store','PaymentController@payment_store')->name('payment.store');
     Route::get('/payment/success','PaymentController@payment_success')->name('payment.success');

     //subscribe
     Route::post('/subscribe','SubscriptionController@subscribe')->name('subscribe');

     //contact
     Route::get('/contact','FrontEndController@contact')->name('contact');
        
 });

});
/* front end */

Route::group(['middleware'=>"admin"],function(){

/*additional*/
 Route::group(['prefix'=>"get",'as'=>'get.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/subcategory','AdditionalController@get_subcategory')->name('subcategory');
     Route::get('/subscribers','AdditionalController@subscribers')->name('subscribers');
 });
/*additional*/

/*category*/
 Route::group(['prefix'=>"category",'as'=>'category.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','CategoryController@index')->name('index');
     Route::get('/create','CategoryController@create')->name('create');
     Route::post('/store','CategoryController@store')->name('store');
     Route::get('/edit/{id}','CategoryController@edit')->name('edit');
     Route::post('/update','CategoryController@update')->name('update');
     Route::get('/delete/{id}','CategoryController@delete')->name('delete');

     Route::get('/homw/show/no/{id}','CategoryController@home_show_no')->name('home.show.no');
     Route::get('/homw/show/yes/{id}','CategoryController@home_show_yes')->name('home.show.yes');
 });
/*category*/

/*subcategory*/
 Route::group(['prefix'=>"subcategory",'as'=>'subcategory.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','SubcategoryController@index')->name('index');
     Route::get('/create','SubcategoryController@create')->name('create');
     Route::post('/store','SubcategoryController@store')->name('store');
     Route::get('/edit/{id}','SubcategoryController@edit')->name('edit');
     Route::post('/update','SubcategoryController@update')->name('update');
     Route::get('/delete/{id}','SubcategoryController@delete')->name('delete');
 });
/*subcategory*/

/*brand*/
 Route::group(['prefix'=>"brand",'as'=>'brand.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','BrandController@index')->name('index');
     Route::get('/create','BrandController@create')->name('create');
     Route::post('/store','BrandController@store')->name('store');
     Route::get('/edit/{id}','BrandController@edit')->name('edit');
     Route::post('/update','BrandController@update')->name('update');
     Route::get('/delete/{id}','BrandController@delete')->name('delete');
 });
/*brand*/

/* menu */
Route::group(['prefix'=>"menu",'as'=>'menu.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','MenuController@index')->name('index');
    Route::get('/create','MenuController@create')->name('create');
    Route::post('/store','MenuController@store')->name('store');
    Route::get('/edit/{id}','MenuController@edit')->name('edit');
    Route::post('/update','MenuController@update')->name('update');
    Route::get('/delete/{id}','MenuController@delete')->name('delete');
});
/* menu */

/*unit*/
 Route::group(['prefix'=>"unit",'as'=>'unit.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','UnitController@index')->name('index');
     Route::get('/create','UnitController@create')->name('create');
     Route::post('/store','UnitController@store')->name('store');
     Route::get('/edit/{id}','UnitController@edit')->name('edit');
     Route::post('/update','UnitController@update')->name('update');
     Route::get('/delete/{id}','UnitController@delete')->name('delete');
 });
/*unit*/

/*color*/
 Route::group(['prefix'=>"color",'as'=>'color.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','ColorController@index')->name('index');
     Route::get('/create','ColorController@create')->name('create');
     Route::post('/store','ColorController@store')->name('store');
     Route::get('/edit/{id}','ColorController@edit')->name('edit');
     Route::post('/update','ColorController@update')->name('update');
     Route::get('/delete/{id}','ColorController@delete')->name('delete');
 });
/*color*/

/*size*/
 Route::group(['prefix'=>"size",'as'=>'size.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','SizeController@index')->name('index');
     Route::get('/create','SizeController@create')->name('create');
     Route::post('/store','SizeController@store')->name('store');
     Route::get('/edit/{id}','SizeController@edit')->name('edit');
     Route::post('/update','SizeController@update')->name('update');
     Route::get('/delete/{id}','SizeController@delete')->name('delete');
 });
/*size*/


/*coupon*/
 Route::group(['prefix'=>"coupon",'as'=>'coupon.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','CouponController@index')->name('index');
     Route::get('/create','CouponController@create')->name('create');
     Route::post('/store','CouponController@store')->name('store');
     Route::get('/edit/{id}','CouponController@edit')->name('edit');
     Route::post('/update','CouponController@update')->name('update');
     Route::get('/delete/{id}','CouponController@delete')->name('delete');
 });
/*coupon*/

/*logo*/
 Route::group(['prefix'=>"logo",'as'=>'logo.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','LogoController@index')->name('index');
     Route::get('/create','LogoController@create')->name('create');
     Route::post('/store','LogoController@store')->name('store');
     Route::get('/edit/{id}','LogoController@edit')->name('edit');
     Route::post('/update','LogoController@update')->name('update');
     Route::get('/delete/{id}','LogoController@delete')->name('delete');
 });
/*logo*/

/* banner */
 Route::group(['prefix'=>"banner",'as'=>'banner.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','BannerController@index')->name('index');
     Route::get('/create','BannerController@create')->name('create');
     Route::post('/store','BannerController@store')->name('store');
     Route::get('/edit/{id}','BannerController@edit')->name('edit');
     Route::post('/update','BannerController@update')->name('update');
     Route::get('/delete/{id}','BannerController@delete')->name('delete');
 });
/* banner */

/*slider*/
 Route::group(['prefix'=>"slider",'as'=>'slider.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','SliderController@index')->name('index');
     Route::get('/create','SliderController@create')->name('create');
     Route::post('/store','SliderController@store')->name('store');
     Route::get('/edit/{id}','SliderController@edit')->name('edit');
     Route::post('/update','SliderController@update')->name('update');
     Route::get('/delete/{id}','SliderController@delete')->name('delete');
 });
/*slider*/



/*product*/
 Route::group(['prefix'=>"product",'as'=>'product.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
     Route::get('/list','ProductController@index')->name('index');
     Route::get('/create','ProductController@create')->name('create');
     Route::post('/store','ProductController@store')->name('store');
     Route::get('/delete/{id}','ProductController@delete')->name('delete');
     Route::get('/edit/{id}','ProductController@edit')->name('edit');
     Route::post('/update','ProductController@update')->name('update');
     Route::get('/duplicate/{id}','ProductController@duplicate')->name('duplicate');
     Route::get('/delete/gallery/image/{id}/{index}','ProductController@deleteGalleryImage')->name('delete.gallery');

     Route::get('/inactive/{id}','ProductController@inactive')->name('inactive');
     Route::get('/active/{id}','ProductController@active')->name('active');

        Route::get('/nofeatured/{id}','ProductController@nofeatured')->name('nofeatured');
     Route::get('/featured/{id}','ProductController@featured')->name('featured');

     Route::get('/todays/deal/active/{id}','ProductController@todays_deal_active')->name('todays.deal.active');
     Route::get('/todays/deal/inactive/{id}','ProductController@todays_deal_inactive')->name('todays.deal.inactive');
 });
/*product*/

/* general */
 Route::group(['prefix'=>"general",'as'=>'general.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/create','GeneralController@create')->name('create');
     Route::post('/store','GeneralController@store')->name('store');
     Route::get('/{id}/edit','GeneralController@edit')->name('edit');
     Route::patch('/{id}/update','GeneralController@update')->name('update');

 });
/* general */

/* general */
 Route::group(['prefix'=>"shipping-charge",'as'=>'shipping-charge.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/create','ShippingChargeController@create')->name('create');
     Route::post('/store','ShippingChargeController@store')->name('store');
     Route::get('/{id}/edit','ShippingChargeController@edit')->name('edit');
     Route::patch('/{id}/update','ShippingChargeController@update')->name('update');

 });
/* general */

/* primary color */
 Route::group(['prefix'=>"primary-color",'as'=>'primary-color.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/create','PrimaryColorController@create')->name('create');
     Route::post('/store','PrimaryColorController@store')->name('store');
     Route::get('/{id}/edit','PrimaryColorController@edit')->name('edit');
     Route::patch('/{id}/update','PrimaryColorController@update')->name('update');

 });
/* primary color */

/* backend order process */
 Route::group(['prefix'=>"order",'as'=>'order.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/list','OrderController@list')->name('list');
     Route::get('/todays','OrderController@todays_order')->name('todays');
     Route::get('/details/{info_id}/{id}','OrderController@details')->name('details');
     Route::get('/print/{info_id}/{id}','OrderController@print')->name('print');

     Route::get('/approved/delivery/status/{info_id}/{id}','OrderController@delivery_status_approved')->name('approved.delivery.status');

     Route::get('/approved/payment/status/{info_id}/{id}','OrderController@payment_status_paid')->name('approved.payment.status');

 });
/* backend order process */

/* report */
 Route::group(['prefix'=>"report",'as'=>'report.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/stock','ReportController@stock')->name('stock');
     Route::get('/product/wise','ReportController@product_wise_sale')->name('product.wise.sale');

 });
/* report */

/* profile */
 Route::group(['prefix'=>"profile",'as'=>'profile.','namespace'=>"App\Http\Controllers\BackEnd"],function(){

     Route::get('/change/password','ProfileController@change_password')->name('change.password');
     Route::post('/change/password/updated','ProfileController@password_updated')->name('change.password.updated');

 });
/* profile */

 /*Pages*/
Route::group(['prefix'=>"page",'as'=>'page.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','PageController@index')->name('index');
    Route::get('/create','PageController@create')->name('create');
    Route::post('/store','PageController@store')->name('store');
    Route::get('/edit/{id}','PageController@edit')->name('edit');
    Route::post('/update','PageController@update')->name('update');
    Route::get('/delete/{id}','PageController@delete')->name('delete');
    Route::get('/status/{id}','PageController@status')->name('status');
});
/*Pages*/

/*Notice*/
Route::group(['prefix'=>"notice",'as'=>'notice.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','NoticeController@index')->name('index');
    Route::get('/create','NoticeController@create')->name('create');
    Route::post('/store','NoticeController@store')->name('store');
    Route::get('/edit/{id}','NoticeController@edit')->name('edit');
    Route::post('/update','NoticeController@update')->name('update');
    Route::get('/delete/{id}','NoticeController@delete')->name('delete');
    Route::get('/status/{id}','NoticeController@status')->name('status');
});
/*Notice*/

/*Link Type*/
Route::group(['prefix'=>"link_type",'as'=>'link_type.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','LinkTypeController@index')->name('index');
    Route::get('/create','LinkTypeController@create')->name('create');
    Route::post('/store','LinkTypeController@store')->name('store');
    Route::get('/edit/{id}','LinkTypeController@edit')->name('edit');
    Route::post('/update','LinkTypeController@update')->name('update');
    Route::get('/delete/{id}','LinkTypeController@delete')->name('delete');
    Route::get('/status/{id}','LinkTypeController@status')->name('status');
});
/*Link type*/

/*Links*/
Route::group(['prefix'=>"link",'as'=>'link.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','LinkController@index')->name('index');
    Route::get('/create','LinkController@create')->name('create');
    Route::post('/store','LinkController@store')->name('store');
    Route::get('/edit/{id}','LinkController@edit')->name('edit');
    Route::post('/update','LinkController@update')->name('update');
    Route::get('/delete/{id}','LinkController@delete')->name('delete');
    Route::get('/status/{id}','LinkController@status')->name('status');
});
/*Links*/

/*Social*/
Route::group(['prefix'=>"social",'as'=>'social.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','SocialController@index')->name('index');
    Route::get('/create','SocialController@create')->name('create');
    Route::post('/store','SocialController@store')->name('store');
    Route::get('/edit/{id}','SocialController@edit')->name('edit');
    Route::post('/update','SocialController@update')->name('update');
    Route::get('/delete/{id}','SocialController@delete')->name('delete');
});
/*Social*/

/*Free Shipping Limit*/
Route::group(['prefix'=>"free-shipping-limit",'as'=>'free-shipping-limit.','namespace'=>"App\Http\Controllers\BackEnd"],function(){
    Route::get('/list','FreeShippingLimitController@index')->name('index');
    Route::get('/create','FreeShippingLimitController@create')->name('create');
    Route::post('/store','FreeShippingLimitController@store')->name('store');
    Route::get('/edit/{id}','FreeShippingLimitController@edit')->name('edit');
    Route::post('/update','FreeShippingLimitController@update')->name('update');
    Route::get('/delete/{id}','FreeShippingLimitController@delete')->name('delete');
    Route::get('/status/{id}','FreeShippingLimitController@status')->name('status');
});
/*Free Shipping Limit*/

//     Route::group(['prefix'=>"details",'as'=>'details.','namespace'=>"App\Http\Controllers"],function(){
//         Route::get('/admin/purchase/details/{id}','HomeController@AdminPurchaseHistoryDetails')->name('admin.purchase.details');
//     });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/purchase/details/{id}', [App\Http\Controllers\HomeController::class, 'adminPurchaseHistoryDetails'])->name('admin.purchase.details');

Route::group(['middleware'=>'frontend'],function(){

    Route::group(['as'=>'front.','namespace'=>"App\Http\Controllers\FrontEnd"],function(){
        Route::get('/{slug}','FrontEndController@pages');
    });

});

