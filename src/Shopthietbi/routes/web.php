<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/', 'HomeController@index');
Route::get('/contact-us', 'HomeController@contact_us');
Route::get('/trang_chu', 'HomeController@index');
Route::get('/tim-kiem/{search}', 'HomeController@search');
Route::get('/rating', 'HomeController@rating');
Route::get('/comment', 'HomeController@comment');

Route::get('/filter-price/start={start_price}end={end_price}', 'HomeController@filter_price');
Route::post('/autocomplete-search', 'HomeController@autocomplete_search');
//customer
Route::get('/dia-chi', 'CustomerController@address');
Route::get('/add-address', 'CustomerController@add_address');
Route::post('/save-address', 'CustomerController@save_address');
Route::get('/edit-address/{address_id}', 'CustomerController@edit_address');
Route::get('/delete-address/{address_id}', 'CustomerController@delete_address');
Route::get('/choose-address/{address_id}', 'CustomerController@choose_address');
Route::post('/update-address/{address_id}', 'CustomerController@update_address');
Route::get('/history-order', 'CustomerController@history_order');
Route::get('/cancel-order/{order_id}', 'CustomerController@cancel_order');
Route::get('/checked-order/{order_id}', 'CustomerController@checked_order');

Route::get('/order-detail/{order_id}', 'CustomerController@order_detail');
Route::post('/add-wishlist', 'CustomerController@add_wishlist');
Route::get('/show-wishlist', 'CustomerController@show_wishlist');
Route::get('/delete-wishlist/{product_id}', 'CustomerController@delete_wishlist');
//Sản phẩm theo danh mục
Route::get('/danh-muc/{category_slug}', 'HomeController@show_product_category');
Route::get('/thuong-hieu/{brand_slug}', 'HomeController@show_product_brand');
Route::get('/phu-kien/{accessory_slug}', 'HomeController@show_product_accessory');

//Chi tiết sản phẩm
Route::get('/san-pham/{product_slug}', 'HomeController@product_detail');

//coupon
// Route::get('/unset-coupon', 'CouponController@unset_coupon');
// Route::get('/insert-coupon', 'CouponController@insert_coupon');
// Route::post('/discount-cart', 'CartController@discount_cart');
// Route::post('/save-coupon', 'CouponController@save_coupon');
// Route::get('/list-coupon', 'CouponController@list_coupon');
// Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');
//Cart
// Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{product_id}', 'CartController@delete_cart');
Route::post('/update-cart/{product_id}', 'CartController@update_cart');
Route::post('/add-cart', 'CartController@add_cart');
//login register User
Route::get('/login-register', 'HomeController@login_register');
Route::post('/add-customer', 'HomeController@add_customer');
Route::get('/my-account/{customer_id}', 'HomeController@my_account');
Route::post('/save-name/{customer_id}', 'HomeController@save_name');
Route::post('/change-password/{customer_id}', 'HomeController@change_password');
Route::get('/account-detail/{customer_id}', 'HomeController@account_detail');
Route::get('/logout', 'HomeController@logout');
Route::post('/login', 'HomeController@login');
//Login  google
Route::get('/login-google','CustomerController@login_google');
Route::get('/login-gg/callback','CustomerController@callback_google');
//Checkout
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-checkout', 'CheckoutController@save_checkout');
Route::post('/succes', 'CheckoutController@succes');
Route::get('/send-mail', 'CheckoutController@send_mail');
Route::post('/vnpay-payment', 'CheckoutController@vnpay_payment');
Route::get('/vnpay-return',  'CheckoutController@vnpay_return');

//Backend
Route::get('/login-admin', 'AdminController@index');

Route::get('/dashboard', 'AdminController@dashboard');
Route::get('/logout_admin', 'AdminController@logout');
Route::post('/check_adminlogin', 'AdminController@check_adminlogin');

//Account
Route::group(['middleware' => ['auth:admin', 'checkAdminRole:Quản trị viên,Quản lý']], function () {
    Route::get('/list-account', 'AdminController@list_account');
    Route::get('/list-customer', 'AdminController@list_customer');
});
Route::get('/account-profile/{admin_id}', 'AdminController@account_profile');
Route::post('/update-profile/{admin_id}', 'AdminController@update_profile');
Route::post('/update-phone/{admin_id}', 'AdminController@update_phone');

Route::group(['middleware' => ['auth:admin', 'checkAdminRole:Quản trị viên']], function () {
    Route::post('/save-admin', 'AdminController@save_admin');
    Route::get('/delete-account/{admin_id}', 'AdminController@delete_account');
    Route::post('/permisstion/{role_id}', 'AdminController@permisstion');

});
//CategoryProduct
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');

Route::get('/list-category-product', 'CategoryProduct@list_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::post('/save-category-product', 'CategoryProduct@save_category_product');

//Brand
Route::get('/add-brand', 'BrandProduct@add_brand_product');
Route::get('/edit-brand/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::post('/update-brand/{brand_product_id}', 'BrandProduct@update_brand_product');
Route::get('/delete-brand/{brand_product_id}', 'BrandProduct@delete_brand_product');

Route::get('/list-brand', 'BrandProduct@list_brand_product');
Route::get('/active-brand/{brand_product_id}', 'BrandProduct@active_brand_product');
Route::get('/unactive-brand/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::post('/save-brand', 'BrandProduct@save_brand_product');
//Slider

Route::get('/add-slider', 'SliderControllder@add_slider');
Route::post('/save-slider', 'SliderControllder@save_slider');
Route::get('/list-slider', 'SliderControllder@list_slider');
Route::get('/change-option/{slider_id}', 'SliderControllder@change_option');
Route::get('/status-slider/{slider_id}', 'SliderControllder@status_slider');
Route::get('/delete-slider/{slider_id}', 'SliderControllder@delete_slider');
Route::get('/edit-slider/{slider_id}', 'SliderControllder@edit_slider');
Route::post('/update-slider/{slider_id}', 'SliderControllder@update_slider');

//Product
Route::get('/add-product', 'ProductController@add_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

Route::get('/list-product', 'ProductController@list_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::post('/save-product', 'ProductController@save_product');

//image product
Route::get('/add-image/{product_id}', 'ProductController@add_image');
Route::post('/save-image', 'ProductController@save_image');
Route::get('/edit-image/{image_id}', 'ProductController@edit_image');
Route::post('/update-image/{image_id}', 'ProductController@update_image');
Route::get('/delete-image/{image_id}', 'ProductController@delete_image');
//promotion
Route::get('/add-promotion', 'PromotionController@add_promotion');
Route::get('/product-promotion/{promotion_id}', 'PromotionController@product_promotion');
Route::post('/chose-product', 'PromotionController@chose_product');
Route::get('/delete-product-promotion/{product_id}', 'PromotionController@delete_product_promotion');

Route::post('/save-promotion', 'PromotionController@save_promotion');
Route::get('/edit-promotion/{promotion_id}', 'PromotionController@edit_promotion');
Route::post('/update-promotion/{promotion_id}', 'PromotionController@update_promotion');
Route::get('/delete-promotion/{promotion_id}', 'PromotionController@delete_promotion');
//accessory
Route::get('/add-accessory', 'AccessoryController@add_accessory');
Route::get('/product-accessory/{accessory_id}', 'AccessoryController@product_accessory');
Route::post('/chose-product-accessory', 'AccessoryController@chose_product_accessory');
Route::get('/delete-product-accessory/{product_id}', 'AccessoryController@delete_product_accessory');

Route::post('/save-accessory', 'AccessoryController@save_accessory');
Route::get('/edit-accessory/{accessory_id}', 'AccessoryController@edit_accessory');
Route::post('/update-accessory/{accessory_id}', 'AccessoryController@update_accessory');
Route::get('/delete-accessory/{accessory_id}', 'AccessoryController@delete_accessory');
//Promotion Accessory
Route::get('/add-promotion-accessory', 'AccessoryController@add_promotion_accessory');
Route::get('/product-promotion-accessory/{promotion_accessory_id}', 'AccessoryController@product_promotion_accessory');
Route::post('/chose-promotion-accessory-product', 'AccessoryController@chose_promotion_accessory_product');
Route::get('/delete-product-promotion-accessory/{product_id}', 'AccessoryController@delete_product_promotion_accessory');

Route::post('/save-promotion-accessory', 'AccessoryController@save_promotion_accessory');
Route::get('/edit-promotion-accessory/{promotion_accessory_id}', 'AccessoryController@edit_promotion_accessory');
Route::post('/update-promotion-accessory/{promotion_accessory_id}', 'AccessoryController@update_promotion_accessory');
Route::get('/delete-promotion-accessory/{promotion_accessory_id}', 'AccessoryController@delete_promotion_accessory');
//Manage Order
Route::group(['middleware' => ['auth:admin', 'checkAdminRole:Quản trị viên,Quản lý']], function () {
    Route::get('/print-order/{checkout_code}', 'OrderController@print_order');
    Route::get('/manage-order', 'OrderController@manage_order');
    Route::get('/view-order/{order_id}', 'OrderController@view_order');
    Route::get('/delete-order/{order_id}', 'OrderController@delete_order');
    Route::get('/acept-order/{order_id}', 'OrderController@acept_order');
});
//Delivery
Route::group(['middleware' => ['auth:admin', 'checkAdminRole:Quản trị viên,Quản lý']], function () {
    Route::get('/manage-delivery', 'DeliveryController@manage_delivery');
    Route::post('/insert-delivery', 'DeliveryController@insert_delivery');
    Route::post('/select-shipping-fee', 'DeliveryController@select_shipping_fee');
    Route::post('/update-delivery', 'DeliveryController@update_delivery');
});
Route::post('/select-delivery', 'DeliveryController@select_delivery');
//Reviews - comment
Route::get('/list-review', 'ReviewController@list_review');
Route::get('/list-comment', 'ReviewController@list_comment');
Route::get('/acept-comment/{comment_id}', 'ReviewController@acept_comment');
Route::get('/delete-comment/{comment_id}', 'ReviewController@delete_comment');

