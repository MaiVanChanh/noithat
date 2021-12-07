<?php

use Illuminate\Support\Facades\Artisan;
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

/* người dùng  */
Route::get('/', 'HomeController@index');
Route::get('/home','HomeController@index');
Route::post('/tim-kiem','HomeController@tim_kiem');
Route::get('/category/{id}','CategoryProduct@show_category');
Route::get('/material/{id}/{id1}','CategoryProduct@show_material');
Route::get('/chitietproduct/{id}','ProductController@chitietproduct');


// Email
Route::get('/send-mail','HomeController@send_mail'); 
/* admin   AdminController*/
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/view-admin','AdminController@view');
Route::get('/edit-admin/{id}','AdminController@editadmin');

Route::get('/edit-mkadmin/{id}','AdminController@editmkadmin');
Route::get('/delete-admin/{id}','AdminController@deleteadmin');

Route::get('/edit-pass','AdminController@editpass');
Route::post('/update-pass/{id}','AdminController@updatepass'); 
Route::post('/update-admin/{id}','AdminController@updateadmin'); 
/* danh mục sản phẩm  CategoryProduct */
Route::get('/add-category','CategoryProduct@addcategory');
Route::get('/all-category','CategoryProduct@allcategory');
Route::get('/edit-category/{id}','CategoryProduct@editcategory');
Route::get('/delete-category/{id}','CategoryProduct@deletecategory');
Route::get('/an-category/{id}','CategoryProduct@ancategory');
Route::get('/hien-category/{id}','CategoryProduct@hiencategory');
Route::post('/save-category','CategoryProduct@savecategory');
Route::post('/update-category/{id}','CategoryProduct@updatecategory');

/* danh mục chất liệu  MaterialProduct  admin*/
Route::get('/add-material','MaterialProduct@add');
Route::get('/all-material','MaterialProduct@all');
Route::get('/edit-material/{id}','MaterialProduct@edit');
Route::get('/delete-material/{id}','MaterialProduct@delete');

Route::get('/an-material/{id}','MaterialProduct@an');
Route::get('/hien-material/{id}','MaterialProduct@hien');

Route::post('/save-material','MaterialProduct@save');
Route::post('/update-material/{id}','MaterialProduct@update');
/* danh sách sản phẩm ProductController */
Route::get('/add-product','ProductController@add');
Route::get('/all-product','ProductController@all');
Route::get('/edit-product/{id}','ProductController@editproduct');
Route::get('/delete-product/{id}','ProductController@deleteproduct');

Route::get('/an-product/{id}','ProductController@anproduct');
Route::get('/hien-product/{id}','ProductController@hienproduct');

Route::post('/save-product','ProductController@save');
Route::post('/update-product/{id}','ProductController@update');
Route::post('/load-comment','ProductController@load_comment');
Route::get('/comment','ProductController@list_comment');
Route::post('/send-comment','ProductController@send_comment');
Route::post('/allow-comment','ProductController@allow_comment');
Route::post('/reply-comment','ProductController@reply_comment');

/* gio hàng */
Route::post('/savegiohang','CartController@savegiohang');
Route::post('/update-gio','CartController@update_gio');
Route::post('/add-gio-hang','CartController@add_gio_hang');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/showgh','CartController@showgh');
Route::get('/delete-gio/{rowId}','CartController@delete');

Route::get('/gio-hang','CartController@gio_hang');
Route::post('/update-cart','CartController@update_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');


/* thanh toán */
Route::post('/order_place','ThanhtoanController@order_place');
Route::post('/login-customer','ThanhtoanController@dangnhap');
Route::get('/muahang','ThanhtoanController@muahang');
Route::get('/checkout','ThanhtoanController@checkout');
Route::post('/save-muahang','ThanhtoanController@save_muahang');

Route::post('/update-vieworder/{id}','ThanhtoanController@update_vieworder');


/*phí vận chuyển*/
Route::post('/select-delivery-home','ThanhtoanController@select_delivery_home');
Route::post('/calculate-fee','ThanhtoanController@calculate_fee');
Route::get('/del-fee','ThanhtoanController@del_fee');
Route::post('/confirm-order','ThanhtoanController@confirm_order');

/* customer*/
Route::post('/add-customer','ThanhtoanController@add_customer');
Route::get('/dn_thanhtoan','ThanhtoanController@dn_thanhtoan');
Route::get('/dk_thanhtoan','ThanhtoanController@dk_thanhtoan');
Route::get('/dx_thanhtoan','ThanhtoanController@dx_thanhtoan');
Route::get('/view-customer','ThanhtoanController@viewcustomer');
Route::get('/edit-customer','ThanhtoanController@editcustomer');
Route::get('/edit-pascustomer','ThanhtoanController@editpascustomer');

//odder admin

Route::get('/manage_order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/delete-order/{order_code}','OrderController@order_code');
Route::post('/update-order-qty','OrderController@update_order_qty');
//Route::post('/huy-don-hang','OrderController@huy_don_hang');
// Route::get('/manage_order','ThanhtoanController@manage_order');
// Route::get('/view-order/{orderId}','ThanhtoanController@view_order');

//              COUPON
// người dùng
Route::post('/check-coupon','CartController@check_coupon');
// admin
Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-couponcode','CouponController@insert_couponcode');
//admin user
Route::get('users','UserController@index');
Route::get('customer','UserController@indexctm');
Route::get('add-admin','UserController@add_admin');
Route::post('store-admin','UserController@store_admin');
Route::post('assign-roles','UserController@assign_roles');
Route::post('reset-admin','UserController@reset_admin');
Route::get('reset-admin1','UserController@reset_admin1');

//Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');
//Gallery
Route::get('add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('select-gallery','GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('update-gallery-name','GalleryController@update_gallery_name');
Route::post('delete-gallery','GalleryController@delete_gallery');
Route::post('update-gallery','GalleryController@update_gallery');
//giới thiệu
Route::get('/add-gioithieu','IntroduceController@add_gioithieu');
Route::post('/save-gioithieu','IntroduceController@save_gioithieu');
Route::get('/all-gioithieu','IntroduceController@all_gioithieu');
Route::get('/delete-gt/{id}','IntroduceController@delete_gt');
Route::get('/edit-gt/{id}','IntroduceController@edit_gt');
Route::get('/an-gt/{id}','IntroduceController@an_gt');
Route::get('/hien-gt/{id}','IntroduceController@hien_gt');
Route::post('/update-gt/{_id}','IntroduceController@update_gt');
Route::get('/gioithieu', 'IntroduceController@gioi_thieu');
Route::get('/show-gioithieu/{id}','IntroduceController@show_gioithieu');

//quen mk customer 
            // NGƯỜI DÙNG
Route::get('/quen-mk', 'MailController@quen_mk');
Route::post('/reset-mk','MailController@reset_mk');
Route::post('/update-new-pass','MailController@update_new_pass');
Route::post('reset-customer','UserController@reset_customer');
//customer admin
Route::get('/an-customer/{id}','AdminController@ancustomer');
Route::get('/hien-customer/{id}','AdminController@hiencustomer');
// print
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/print-customer','AdminController@print_customer');

// customer profile & update mk
Route::post('/update-customer/{id}','UserController@update_customer');
Route::get('/editpass-customer','UserController@editpass_customer');
Route::post('/editpass1-customer/{id}','UserController@editpass1_customer');
