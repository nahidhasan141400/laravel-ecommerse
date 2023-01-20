<?php

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
Route::prefix('admin/welcome')->group(function ()  {
Route::get('/dashboard','Admin\HomeController@admin_dashboard')->name('admin_dashboard')->middleware('lock_screen');
Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin_login');
Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin_login');
Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin_register');
Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin_register');
Route::get('/token/{token}', 'Admin\Auth\VerificationController@verify')->name('adminuser_verification');
Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/resetlink/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
// Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin_login');
// Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin_login');
// Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin_register');
// Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin_register');
// Route::get('/token/{token}', 'Admin\Auth\VerificationController@verify')->name('adminuser_verification');

// Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/resetlink/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/password/confirm', 'Admin\Auth\ConfirmPasswordController@password_confirm')->name('password.confirm');
// Route::post('password/confirm', 'Admin\Auth\ConfirmPasswordController@confirm');

Route::get('/logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');
Route::get('/lock/screen','Admin\HomeController@lock_screen')->name('admin_lock_screen');
Route::post('/unlock/screen','Admin\HomeController@unlock_screen')->name('admin_unlock_screen');


Route::get('/product/brands','Admin\BrandController@admin_product_brand')->name('admin_product_brand');
Route::post('/product/brands/save','Admin\BrandController@admin_product_brand_save')->name('admin_product_brand_save');

Route::post('/product/brands/edit/save/{id}','Admin\BrandController@admin_product_brand_edit_save')->name('admin_product_brand_edit_save');
Route::get('/product/brands/delete/{id}','Admin\BrandController@admin_product_brand_delete_show')->name('admin_product_brand_delete');
Route::get('/product/brands/active/{id}','Admin\BrandController@admin_product_brand_active_show')->name('admin_product_brand_active');
Route::get('/product/brands/deactive/{id}','Admin\BrandController@admin_product_brand_deactive_show')->name('admin_product_brand_deactive');

Route::get('/product/category','Admin\CategoryController@admin_product_category')->name('admin_product_category');
Route::post('/product/category/save','Admin\CategoryController@admin_product_category_save')->name('admin_product_category_save');

Route::post('/product/category/edit/save/{id}','Admin\CategoryController@admin_product_category_edit_save')->name('admin_product_category_edit_save');
Route::get('/product/category/delete/{id}','Admin\CategoryController@admin_product_category_delete_show')->name('admin_product_category_delete');
Route::get('/product/category/active/{id}','Admin\CategoryController@admin_product_category_active_show')->name('admin_product_category_active');
Route::get('/product/category/deactive/{id}','Admin\CategoryController@admin_product_category_deactive_show')->name('admin_product_category_deactive');

Route::get('/product','Admin\ProductController@admin_product')->name('admin_product');
Route::get('/product/seller','Admin\ProductController@seller_product')->name('seller_product_in_admin');

Route::get('/flashdeal/show','Admin\ProductController@flash_show')->name('flash_show');
Route::get('/flashdeal','Admin\ProductController@flash_deal')->name('flash_deal');
Route::post('/flashdeal','Admin\ProductController@flash_deal_save')->name('flash_deal_save');
Route::get('/flash/product/active/{id}','Admin\ProductController@flash_product_active')->name('flash_product_active');
Route::get('/flash/product/deactive/{id}','Admin\ProductController@flash_product_deactive')->name('flash_product_deactive');
Route::get('/flash/product/delete/{id}','Admin\ProductController@flash_product_delete')->name('flash_product_delete');
Route::get('/flash/product/edit/{id}','Admin\ProductController@flash_product_edit')->name('flash_product_edit');
Route::post('/flash/product/edit/save/{id}','Admin\ProductController@flash_product_edit_save')->name('flash_product_edit_save');
Route::post('/flashdeal/getproduct/{id}','Admin\ProductController@flashdeal_getproduct')->name('flash_getproduct');

// Route::get('/product/save/show','Admin\ProductController@admin_product_save_show')->name('admin_product_save_show');
Route::post('/product/image/upload','Admin\ProductController@admin_product_image_upload')->name('admin_product_image_upload');
Route::post('/product/save','Admin\ProductController@admin_product_save')->name('admin_product_save');
Route::get('/product/edit/{id}','Admin\ProductController@admin_product_edit_show')->name('admin_product_edit');
Route::post('/product/edit/{id}','Admin\ProductController@admin_product_edit')->name('admin_product_edit');
Route::get('/product/image/delete/{id}','Admin\ProductController@delete_product_image')->name('delete_product_image');
Route::get('/product/delete/{id}','Admin\ProductController@admin_product_delete')->name('admin_product_delete');
Route::get('/product/active/{id}','Admin\ProductController@admin_product_active')->name('admin_product_active');
Route::get('/product/deactive/{id}','Admin\ProductController@admin_product_deactive')->name('admin_product_active');
Route::get('/product/subcategory/{id}','Admin\ProductController@get_sub_category')->name('get_sub_category');
Route::get('/get/product/{id}','Admin\ProductController@get_product')->name('get_product');


Route::get('/featured/product/deactive/{id}','Admin\ProductController@admin_featured_product_deactive')->name('admin_featured_product_deactive');
Route::get('/featured/product/active/{id}','Admin\ProductController@admin_featured_product_active')->name('admin_featured_product_active');

Route::get('/header/setting','Admin\HomeController@header_setting')->name('header_setting');
Route::get('/sidebar/setting','Admin\HomeController@sidebar_setting')->name('sidebar_setting');
Route::get('/body/setting','Admin\HomeController@body_setting')->name('body_setting');
Route::get('/footer/setting','Admin\HomeController@footer_setting')->name('footer_setting');

Route::get('who','Admin\HomeController@who')->name('who');

Route::get('blog','Admin\HomeController@blog')->name('admin_blog');
Route::post('blog/save','Admin\HomeController@blog_save')->name('blog_save');

Route::post('blog/edit/{id}','Admin\HomeController@blogedit')->name('admin_blog_edit');
Route::get('blog/delete/{id}','Admin\HomeController@blogdelete')->name('admin_blog_delete');

Route::get('/pickup/point/status','Admin\ProductController@pick_up_order')->name('pick_up_order');
Route::get('/newslater','Admin\HomeController@newslater')->name('newslater');
Route::post('/newslater','Admin\HomeController@newslater_submit')->name('newslater_submit');

Route::get('/allstaffs','Admin\HomeController@allstaffs')->name('allstaffs');
Route::get('/allstaffs/active/{id}','Admin\HomeController@allstaffs_active')->name('allstaffs_active');
Route::get('/allstaffs/deactive/{id}','Admin\HomeController@allstaffs_deactive')->name('allstaffs_deactive');
Route::get('/allstaffs/delete/{id}','Admin\HomeController@allstaffs_delete')->name('allstaffs_delete');
Route::post('/allstaffs/edit/{id}','Admin\HomeController@allstaffs_edit')->name('allstaffs_edit');
Route::get('/allstaffs/role','Admin\HomeController@allstaffs_role')->name('allstaffs_role');
Route::get('/create/role','Admin\HomeController@create_role')->name('create_role');
Route::post('/save/role','Admin\HomeController@save_role')->name('save_role');
Route::get('/edits/role/{id}','Admin\HomeController@edit_role')->name('edit_role');
Route::get('/edit/role/{id}','Admin\HomeController@edit_role_save')->name('edit_role_save');
Route::get('/delete/role/{id}','Admin\HomeController@delete_role')->name('delete_role');

Route::get('/conversations','Admin\HomeController@conversations_list')->name('conversations_list');
Route::get('/message/{id}','Admin\HomeController@message')->name('message');
Route::get('/message/reply/{id}','Admin\HomeController@message_reply')->name('message_reply');

Route::get('/customers','Admin\HomeController@customers_list')->name('customers_list');
Route::get('/delete/customer/{id}','Admin\HomeController@customers_delete')->name('customers_delete');
Route::get('/customer/details/{id}','Admin\HomeController@customer_details_view')->name('customer_details_view');
Route::post('/be/seller/application/{id}','Admin\HomeController@be_seller_application')->name('be_seller_application');

Route::get('/all/order','Admin\HomeController@all_order')->name('all_order');
Route::get('/order/details/{id}','Admin\HomeController@order_details')->name('order_details');
Route::post('/order/payment/status/update/{id}','Admin\HomeController@order_payment_status')->name('order_payment_status');
Route::post('/order/delivery/status/update/{id}','Admin\HomeController@order_delivery_status')->name('order_delivery_status');
Route::get('/order/delivery/status/update/{id}', function () {
    return back();
});
Route::post('/shipping/{id}','Admin\HomeController@shipping_cost')->name('shipping_cost');

Route::get('/totalsales','Admin\HomeController@totalsales')->name('totalsales_history');
Route::get('/order/delete/{id}','Admin\HomeController@order_delete')->name('order_delete');
Route::get('/order/view/{id}','Admin\HomeController@order_view')->name('order_view');

Route::get('/support/ticket','Admin\HomeController@support_tickets')->name('admin_support_ticket');
Route::get('/supports/ticket/{id}','Admin\HomeController@support_tickets_reply')->name('admin_support_ticket_reply');
Route::get('/support/ticket/{id}','Admin\HomeController@support_tickets_reply_submit')->name('admin_support_ticket_reply_submit');

Route::get('home/seo','Admin\HomeController@home_seo')->name('home_seo');
Route::post('home/seo/submit','Admin\HomeController@home_seo_submit')->name('home_seo_submit');

Route::get('coupon/list','Admin\HomeController@coupon_list')->name('coupon_list');
Route::get('create/coupon','Admin\HomeController@coupon_create')->name('coupon_create');
Route::post('create/coupon/submit','Admin\HomeController@coupon_create_submit')->name('coupon_create_submit');
Route::get('/coupon/delete/{id}','Admin\HomeController@coupon_delete')->name('coupon_delete');

Route::get('frontend/home','Admin\HomeController@frontend_home')->name('frontend_home');

Route::post('/add/slider','Admin\HomeController@add_slider')->name('add_slider');
Route::get('slider/delete/{id}','Admin\HomeController@slider_delete')->name('slider_delete');
Route::get('slider/active/{id}','Admin\HomeController@slider_active')->name('slider_active');
Route::get('slider/deactive/{id}','Admin\HomeController@slider_deactive')->name('slider_deactive');


Route::post('add/banner','Admin\HomeController@add_banner')->name('add_banner');
Route::get('banner/delete/{id}','Admin\HomeController@banner_delete')->name('banner_delete');
Route::get('banner/active/{id}','Admin\HomeController@banner_active')->name('banner_active');
Route::get('banner/deactive/{id}','Admin\HomeController@banner_deactive')->name('banner_deactive');

Route::get('general/setting','Admin\HomeController@general_setting')->name('general_setting');
Route::post('general/setting','Admin\HomeController@general_setting_submit')->name('general_setting_submit');

Route::get('about/us','Admin\HomeController@about_us')->name('about_us');
Route::get('return/policy','Admin\HomeController@return_policy')->name('return_policy');
Route::get('size/guide','Admin\HomeController@size_guide')->name('size_guide');
Route::get('terms/condition','Admin\HomeController@terms_condition')->name('terms_condition');
Route::get('faq','Admin\HomeController@faq')->name('faq');
Route::get('contact','Admin\HomeController@contact')->name('contact');
Route::post('all/policy','Admin\HomeController@allpolicy')->name('allpolicy');

Route::get('usefulinks','Admin\HomeController@usefullinks')->name('usefullinks');
Route::post('create/usefullink/','Admin\HomeController@usefullink_create')->name('usefullink_create');
Route::post('edit/usefullink/{id}','Admin\HomeController@usefullink_edit')->name('usefullink_edit');
Route::get('usefullink/delete/{id}','Admin\HomeController@usefullink_delete')->name('usefullink_delete');

Route::get('cycle/counting','Admin\HomeController@cycle_counting')->name('cycle_counting');

Route::get('stock/report','Admin\HomeController@stock_report')->name('stock_report');
Route::get('sale/report','Admin\HomeController@sale_report')->name('sale_report');
Route::get('wish/report','Admin\HomeController@wish_report')->name('wish_report');

Route::get('invoice/download/{id}/{order_code}','Admin\HomeController@pdf_download')->name('pdf_download');


Route::get('supplierlist','Admin\HomeController@supplier_list')->name('supplier_list');
Route::post('supplierlist/submit','Admin\HomeController@supplier_list_submit')->name('supplier_list_submit');
Route::get('supplierlist/delete/{id}','Admin\HomeController@supplier_list_delete')->name('supplier_list_delete');
Route::get('supplier/active/{id}','Admin\HomeController@supplier_active')->name('supplier_active');
Route::get('supplier/deactive/{id}','Admin\HomeController@supplier_deactive')->name('supplier_deactive');

Route::get('purchase/product','Admin\HomeController@purchase_product')->name('purchase_product');
Route::post('/purchase/product/submit','Admin\HomeController@purchase_product_save')->name('purchase_product_save');
Route::get('/purchase/product/active/{id}','Admin\HomeController@purchase_product_active')->name('purchase_product_active');
Route::get('/purchase/product/deactive/{id}','Admin\HomeController@purchase_product_deactive')->name('purchase_product_deactive');
Route::get('/purchase/product/delete/{id}','Admin\HomeController@purchase_product_delete')->name('purchase_product_delete');
Route::get('/purchase/product/edit/{id}','Admin\HomeController@purchase_product_edit')->name('purchase_product_edit');
Route::post('/purchase/product/edit/submit/{id}','Admin\HomeController@purchase_product_edit_submit')->name('purchase_product_edit_submit');
Route::get('/purchase/invoice/{id}/{order_id}','Admin\HomeController@pdf_purchaseproduct')->name('pdf_purchaseproduct');
Route::get('/purchase/product/category/{id}','Admin\HomeController@purchase_product_category')->name('purchase_product_category');

Route::get('inhouse/products','Admin\HomeController@in_house_products')->name('in_house_products');
Route::post('inproduct/submit','Admin\HomeController@in_house_products_submit')->name('in_house_products_submit');
Route::post('inproduct/update/submit/{id}','Admin\HomeController@in_house_products_update__submit')->name('in_house_products_update__submit');
Route::get('inproduct/delete/{id}','Admin\HomeController@in_house_products_delete')->name('in_house_products_delete');
Route::get('inorder/details','Admin\HomeController@inorder_view')->name('inorder_view');




Route::get('payment/method','Admin\HomeController@payment_i')->name('payment_i');
Route::post('payment/method/submit','Admin\HomeController@payment_method_submit')->name('payment_method_submit');


});
// Admin End

Route::prefix('be/welcome')->group(function ()  {
Route::get('/dashboard','Supplier\HomeController@supplier_dashboard')->name('supplier_dashboard');
Route::get('/login', 'Supplier\Auth\LoginController@showLoginForm')->name('supplier_login');
Route::post('/login', 'Supplier\Auth\LoginController@login')->name('supplier_login');
Route::get('/register', 'Supplier\Auth\RegisterController@showRegistrationForm')->name('supplier_register');
Route::post('register', 'Supplier\Auth\RegisterController@register')->name('supplier_register');
Route::get('/token-{token}', 'Supplier\Auth\VerificationController@verify')->name('supplieruser_verification');

Route::get('/password/reset', 'Supplier\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Supplier\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/resetlink/{token}', 'Supplier\Auth\ResetPasswordController@showResetForm')->name('supplier.password.reset');
Route::post('password/reset', 'Supplier\Auth\ResetPasswordController@reset')->name('password.update');
// Route::get('/login', 'Supplier\Auth\LoginController@showLoginForm')->name('supplier_login');
// Route::post('/login', 'Supplier\Auth\LoginController@login')->name('supplier_login');
// Route::get('/register', 'Supplier\Auth\RegisterController@showRegistrationForm')->name('supplier_register');
// Route::post('register', 'Supplier\Auth\RegisterController@register')->name('supplier_register');
// Route::get('/token-{token}', 'Supplier\Auth\VerificationController@verify')->name('supplieruser_verification');

// Route::get('/password/reset', 'Supplier\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('/password/email', 'Supplier\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('/password/resetlink/{token}', 'Supplier\Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Supplier\Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/password/confirm', 'supplier\Auth\ConfirmPasswordController@password_confirm')->name('password.confirm');
// Route::post('password/confirm', 'supplier\Auth\ConfirmPasswordController@confirm');

Route::get('/logout', 'Supplier\Auth\LoginController@logout')->name('supplier_logout');
Route::get('/lock/screen','Supplier\HomeController@lock_screen')->name('lock_screen');


Route::get('/wishlist','Supplier\HomeController@wishlist')->name('wishlist_back');
Route::get('delete/wishlist/{id}','Supplier\HomeController@delete_wishlist')->name('delete_wishlist');

Route::get('/conversation','Supplier\HomeController@conversations_list')->name('supplier_conversation');
Route::get('/conversation/{id}','Supplier\HomeController@conversations_message')->name('supplier_message');
Route::get('/conversation/reply/{id}','Supplier\HomeController@conversations_message_reply')->name('supplier_message_reply');

Route::get('/manage/profile','Supplier\HomeController@manage_profile')->name('manage_profile');
Route::post('/manage/profile','Supplier\HomeController@manage_profile_update')->name('manage_profile');

Route::get('create/support/ticket','Supplier\HomeController@create_support_ticket')->name('create_support_ticket');
Route::get('create/support/ticket/submit','Supplier\HomeController@create_support_ticket_submit')->name('create_support_ticket_submit');
Route::get('/support/ticket','Supplier\HomeController@support_ticket')->name('support_ticket');
Route::get('/support/ticket/{id}','Supplier\HomeController@support_tickets_reply')->name('supplier_support_ticket_reply');
Route::get('/support/ticket/reply/{id}','Supplier\HomeController@support_ticket_reply_submit')->name('supplier_support_ticket_reply_submit');

Route::get('/be/seller','Supplier\HomeController@be_seller')->name('be_seller');
Route::post('/be/seller/submit','Supplier\HomeController@be_seller_submit')->name('be_seller_submit');


Route::get('/purchase','Supplier\PurchaseController@purchase')->name('purchase');
Route::get('/purchase/details/{id}','Supplier\PurchaseController@purchase_details')->name('purchase_details');

// Route::get('/header/setting','Supplier\HomeController@header_setting')->name('header_setting');
// Route::get('/sidebar/setting','Supplier\HomeController@sidebar_setting')->name('sidebar_setting');
// Route::get('/body/setting','Supplier\HomeController@body_setting')->name('body_setting');
// Route::get('/footer/setting','Supplier\HomeController@footer_setting')->name('footer_setting');

Route::get('/product','Supplier\HomeController@seller_product')->name('seller_product');
Route::post('/product/image/upload','Supplier\HomeController@seller_product_image_upload')->name('seller_product_image_upload');
Route::post('/product/save','Supplier\HomeController@seller_product_save')->name('seller_product_save');

});
//Supplier End
Route::get('/','Supplier\ProductController@home')->name('home');
Route::get('/buy/{id}','Supplier\CartController@buy')->name('buy');
Route::get('/cart/{id}','Supplier\CartController@cart')->name('cart');
Route::get('/cart/r/{id}','Supplier\CartController@remove_cart')->name('remove_cart');
Route::get('/cart/r/{id}/{user_id}','Supplier\CartController@remove_cart_auth')->name('remove_cart_auth');
Route::get('/carts/view/','Supplier\CartController@cart_view')->name('view_cart');
Route::post('/carts/update/{id}','Supplier\CartController@update_cart')->name('update_cart');
Route::get('/checkout','Supplier\CheckoutController@checkout')->name('checkout');
Route::post('/checkout/submit','Supplier\CheckoutController@checkout_submit')->name('checkout_submit');
Route::post('give/review/{id}','Supplier\CartController@give_review')->name('give_review');
Route::get('/wishlist/{id}','Supplier\WishlistController@wishlist')->name('wishlist');
Route::get('/wishlist','Supplier\WishlistController@wishlist_view')->name('view_wishlist');
Route::get('/view/{id}-{slug}','Supplier\ProductController@product_view')->name('product_view');
Route::get('/category/{id}-{slug}','Supplier\ProductController@main_category')->name('main_category');
Route::get('/categorys/{id}-{slug}-{slugs}','Supplier\ProductController@sub_category')->name('sub_category');
Route::get('/brand/{id}-{name}','Supplier\ProductController@brand')->name('brand');
Route::get('/login', 'Supplier\Auth\LoginController@showLoginForm')->name('login');
Route::get('/search','Supplier\ProductController@search')->name('search');
Route::get('/search/{query}','Supplier\ProductController@sort')->name('sort');
Route::get('category/search/{query}','Supplier\ProductController@category_sort')->name('category_sort');
Route::get('subcategory/search/{query}','Supplier\ProductController@sub_category_sort')->name('sub_category_sort');
Route::get('brand/search/{query}','Supplier\ProductController@brand_sort')->name('brand_sort');
Route::post('/subscribe','Supplier\ProductController@subscribe')->name('subscribe');
Route::post('/message/{id}','Supplier\HomeController@short_message')->name('short_message');
Route::get('/compare','Supplier\ProductController@view_compare')->name('view_compare');
Route::get('/compare/{id}','Supplier\ProductController@compare')->name('compare');
Route::post('/coupon/verify','Supplier\ProductController@coupon_verify')->name('coupon_verify');
Route::get('/flashdeal/{value}','Supplier\ProductController@flashdeal')->name('flashdeal_product');
Route::get('/flashdeal/{id}/{slug}','Supplier\ProductController@flashdeal_product_view')->name('flashdeal_product_view');
Route::get('/policy/{value}','Supplier\ProductController@policy')->name('policy');




// SSLCOMMERZ Start
// Supplier\CheckoutController
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax')->name('pay_via_ajax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@cancel');
//SSLCOMMERZ END