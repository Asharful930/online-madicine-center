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


// routes without middleware

Auth::routes();
Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('seller/login', 'Auth\LoginController@showSellerLoginForm')->name('seller.login');
Route::get('admin/register', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('seller/register', 'Auth\RegisterController@showSellerRegisterForm');
Route::post('admin/login', 'Auth\LoginController@adminLogin');
Route::post('seller/login', 'Auth\LoginController@sellerLogin');
Route::post('admin/register', 'Auth\RegisterController@createAdmin');
Route::post('seller/register', 'Auth\RegisterController@createSeller');
Route::get('manager/login', 'Auth\LoginController@showShopLoginForm')->name('manager.login');
Route::post('manager/login', 'Auth\LoginController@shopLogin');

Route::get('/', 'HomeController@welcome')->name('/');
Route::get('/shipping-payment', 'HomeController@shippingPayment')->name('shippingPayment');
Route::get('/terms-conditions', 'HomeController@termsAndConditons')->name('termsAndConditons');
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacyPolicy');
Route::get('/medicine/{medicine}', 'HomeController@medicineSingle')->name('medicine.single');
Route::get('/search/medicine', 'MedicineController@searchMedicines')->name('medicine.search');
Route::get('/add-to-cart/{medicine}', 'OrderController@addCart')->name('cart.add');
Route::patch('/update-cart/{medicine}', 'OrderController@updateCart')->name('cart.update');
Route::delete('/delete-cart/{medicine}', 'OrderController@destroyCart')->name('cart.delete');
Route::get('/cart', 'OrderController@showCart')->name('cart.show');
//seller reset
Route::get('seller_password/reset', 'SellerAuth\ForgotPasswordController@showLinkRequestForm')->name('sellerReset.form');
Route::post('seller_password/email', 'SellerAuth\ForgotPasswordController@sendResetLinkEmail')->name('seller.sentEmail');
Route::get('seller_password/reset/{token}', 'SellerAuth\ResetPasswordController@showResetForm');
Route::post('seller_password/reset', 'SellerAuth\ResetPasswordController@reset');
//Password admin reset routes
Route::get('admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('adminReset.form');;
Route::post('admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sentEmail');
Route::get('admin_password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
Route::post('admin_password/reset', 'AdminAuth\ResetPasswordController@reset');

//routes with middleware
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/approval', 'AdminController@adminApproval')->name('admin.approval');
    Route::get('/admin/profile/{admin}', 'AdminController@adminProfile')->name('admin.profile');
    Route::get('admin/update-admin/{admin}', 'AdminController@editAdmin')->name('admin.editAdmin');
    Route::patch('admin/update-admin/{admin}', 'AdminController@updateAdmin')->name('admin.updateAdmin');
});
Route::middleware(['seller'])->group(function () {
    Route::get('/seller/approval', 'SellerController@sellerApproval')->name('seller.approval');
});


Route::middleware(['admin', 'admin.approved'])->group(function () {
    Route::get('/admin-dashboard', 'AdminController@index')->name('admin.index');
    Route::get('/admin/shops/request', 'ShopController@checkApprove')->name('admin.shop.requestApproved');
    Route::patch('/admin/shop/{shop}/active', 'ShopController@aciveShop')->name('edit.shop.activation');
    Route::delete('/admin/shop/{shop}/reject', 'ShopController@rejectShop')->name('edit.shop.reject');

    Route::get('/admin/seller/aproval', 'SellerController@sellerRequest')->name('admin.approval.sellerRequest');
    Route::patch('/admin/seller/approval/{seller}/active', 'SellerController@aciveSeller')->name('edit.seller.activation');
    Route::patch('/admin/seller/approval/{seller}/reject', 'SellerController@rejectSeller')->name('edit.seller.reject');

    Route::get('/admin/Inactive-seller-list', 'AdminController@allInactiveSeller')->name('inactiveseller.list');
    Route::get('/admin/admin-request', 'AdminController@adminRequest')->name('admin.approval.adminRequest');
    Route::patch('/admin/approval/{admin}/active', 'AdminController@aciveAdmin')->name('edit.admin.activation');
    Route::patch('/admin/approval/{admin}/reject', 'AdminController@rejectAdmin')->name('edit.admin.reject');
    Route::patch('admin/seller/{seller}/deactive', 'AdminController@deactiveSeller')->name('ban.seller');
    Route::patch('admin/seller/{seller}/active', 'AdminController@activeSeller')->name('active.seller');
    Route::delete('admin/seller/{medicine}/delete', 'AdminController@delete')->name('admin.deletemedicine');

    Route::get('/admin/approved-seller-list', 'SellerController@allSeller')->name('admin.approval.allSellerList');
    Route::get('/admin/approved-admin-list', 'AdminController@allAdmin')->name('admin.approval.allAdminList');
    Route::get('/admin/shop-list/{seller}', 'AdminController@showShop')->name('admin.shop');
    Route::get('/admin/Medicine-list/{shop}', 'AdminController@showMedicine')->name('admin.medicine');
    Route::get('/admin/checkout/', 'OrderController@adminCheckout')->name('admin.checkout');
    Route::post('/admin/order/place', 'OrderController@adminOrderStore')->name('admin.order.store');
    Route::get('/admin/Prescription-Request', 'AdminController@showPrescription')->name('admin.prescription');
    Route::delete('admin/user-request/{prescription}/delete', 'AdminController@deletePrescription')->name('prescrption.delete');

    Route::get('/admin/order/{order}', 'OrderController@AdminSingleOrder')->name('admin.order.single');

    Route::patch('/order/payment/{payment}', 'PaymentController@verify')->name('admin.payment.verify');
    Route::delete('/order/payment/{payment}', 'PaymentController@declined')->name('admin.payment.declined');
    Route::get('admin/payment/all', 'PaymentController@allPayments')->name('admin.payments.all');
});


Route::middleware(['seller', 'seller.approved'])->group(function () {
    Route::get('seller', 'SellerController@index')->name('seller.index');
    Route::get('seller/request-shop', 'ShopController@shop_request')->name('seller.shop.shopRequest');
    Route::get('seller/approvalshop', 'ShopController@approvalshop')->name('seller.approval.approvalShop');
    Route::post('seller/request-shop', 'ShopController@createShop')->name('seller.shop.shopRequest.store');
    Route::get('seller/seller-profile/{seller}', 'SellerController@sellerProfile')->name('seller.profile');
    Route::get('seller/seller-edit/{seller}', 'SellerController@editSeller')->name('edit.seller');
    Route::patch('seller/seller-update/{seller}', 'SellerController@updateSeller')->name('seller.update');
    Route::get('Seller/shop-edit/{shop}', 'ShopController@editShop')->name('edit.shop');
    Route::patch('Seller/shop-update/{shop}', 'ShopController@updateShop')->name('update.shop');
    Route::delete('Seller/shop-delete/{shop}', 'ShopController@shopDelete')->name('delete.shop');
});

Route::middleware(['user'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/checkout/', 'OrderController@userCheckout')->name('user.checkout');
    Route::post('/user/order/place', 'OrderController@userOrderStore')->name('user.order.store');
    Route::get('/user/order/{order}', 'OrderController@UserSingleOrder')->name('user.order.single');



    Route::get('/user/add-prescription', 'PrescriptionController@addPrescription')->name('add.prescription');
    Route::get('/user/profile/{user}', 'UserController@userProfile')->name('user.profile');
    Route::get('/user/profile-edit/{user}', 'UserController@editUser')->name('edit.profile');
    Route::get('/user/your-request', 'PrescriptionController@userRequest')->name('show.request');
    Route::get('/user/edit-request/{prescription}', 'PrescriptionController@prescriptionUpdate')->name('edit.request');
    //post methpod
    Route::post('/user/Prescription-store', 'PrescriptionController@prescriptionAdd')->name('store.prescription');
    Route::patch('/user/profile-update/{user}', 'UserController@updateUser')->name('update.profile');
    Route::get('/order/payment/{order}', 'PaymentController@index')->name('user.order.payment');
    Route::post('/order/payment/{order}', 'PaymentController@store')->name('user.payment.store');

    Route::get('/payment/all', 'PaymentController@allUserPayments')->name('user.payment.all');
    Route::post('/order/rating/{order}', 'OrderController@orderRating')->name('user.order.rating');
});

Route::middleware(['manager'])->group(function () {
    Route::get('/manager/approval', 'ShopController@managerApproval')->name('manager.approval');
});
Route::middleware(['manager', 'manager.approved'])->group(function () {
    Route::get('/shop', 'ShopController@index')->name('manager.index');
    Route::get('/shop/medicine-entry', 'MedicineController@create')->name('medicine.input-form');
    Route::post('/shop/medicine-entry', 'MedicineController@MedicineEntry')->name('medicine.store');
    Route::get('/shop/medicine-list', 'MedicineController@medicineList')->name('medicine.medicineList');
    Route::get('/shop/edit-medicine/{medicine}', 'MedicineController@editMedicine')->name('medicine.edit');
    Route::patch('/shop/edit-medicine/{medicine}', 'MedicineController@updateMedicine')->name('medicine.update');
    Route::delete('/shop/medcine-delete/{medicine}/delete', 'MedicineController@delete')->name('medicine.delete');
    Route::get('shop/manager-profile/{shop}', 'ShopController@managerProfile')->name('manager.profile');
    Route::get('Shop/manager-profile-edit/{shop}', 'ShopController@editManager')->name('manager.edit');
    Route::patch('Shop/manager-Update/{shop}', 'ShopController@updateManager')->name('manager.update');

    Route::get('/shop/order/{order}', 'OrderController@ShopSingleOrder')->name('shop.order.single');
    Route::get('/order/shipped/{order_detail}', 'OrderController@shippedProduct')->name('medicine.shipped');
});
