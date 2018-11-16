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


// Frontend
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/aboutus', 'AboutController@index')->name('about');
    Route::get('/termsandcondition', 'TermsController@index')->name('terms');
    Route::get('/history', 'HistoryController@index')->name('history');
    Route::get('/faq', 'FaqController@index')->name('faq');

    Route::get('/bidnow/{id}', 'BidController@index')->name('bidnow')->where(array('id' => '[0-9]+'));
    Route::post('/bid/pricevalidation', 'BidController@priceValidation')->name('bid.pricevalidation');
    Route::post('/bid/qtyvalidation', 'BidController@qtyValidation')->name('bid.qtyvalidation');
    Route::post('/bid/store', 'BidController@store')->name('bid.store');
    Route::get('/bid/edit/{id}', 'BidController@edit')->name('bid.edit')->where(array('id' => '[0-9]+'));
    Route::post('/mybid/amend', 'BidController@amend')->name('mybid.amend');
    Route::get('/mybids', 'BidController@mybid')->name('mybids');
    Route::get('/mybid/cancel/{id}', 'BidController@cancel')->name('mybid.cancel')->where(array('id' => '[0-9]+'));

    Route::get('/signup', 'SignupController@index')->name('customer.signup');
    Route::post('/customer/store', 'SignupController@store')->name('customer.store');
    Route::post('/customer/availability', 'SignupController@availability')->name('customer.availability');

    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('customer.login');
    Route::get('/logout','LoginController@logout')->name('customer.logout');

});


Route::prefix('admin')->group(function () {
    Auth::routes();
});

// Backend
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/pages', 'PageController@index')->name('pages');
Route::get('page/edit/{id}', 'PageController@edit')->name('page.edit')->where(array('id' => '[0-9]+'));
Route::post('/page/update', 'PageController@update')->name('page.update');

Route::get('/items', 'ItemController@index')->name('items');
Route::get('/item/add', 'ItemController@create')->name('item.add');
Route::post('/item/store', 'ItemController@store')->name('item.store');
Route::get('/item/edit/{id}', 'ItemController@edit')->name('item.edit')->where(array('id' => '[0-9]+'));
Route::post('/item/update', 'ItemController@update')->name('item.update');

Route::get('/products', 'ProductController@index')->name('products');
Route::get('/product/add', 'ProductController@create')->name('product.add');
Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit')->where(array('id' => '[0-9]+'));
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy')->where(array('id' => '[0-9]+'));

Route::get('/galleries', 'GalleryController@index')->name('galleries');
Route::get('/gallery/add', 'GalleryController@create')->name('gallery.add');
Route::post('/gallery/store', 'GalleryController@store')->name('gallery.store');
Route::get('/gallery/edit/{id}', 'GalleryController@edit')->name('gallery.edit')->where(array('id' => '[0-9]+'));
Route::post('/gallery/update', 'GalleryController@update')->name('gallery.update');
Route::get('/gallery/destroy/{id}', 'GalleryController@destroy')->name('gallery.destroy')->where(array('id' => '[0-9]+'));
Route::post('/gallery/availability', 'GalleryController@availability')->name('gallery.availability');

Route::get('/members', 'MemberController@index')->name('members');
Route::get('/member/add', 'MemberController@create')->name('member.add');
Route::post('/member/store', 'MemberController@store')->name('member.store');
Route::get('/member/edit/{id}', 'MemberController@edit')->name('member.edit')->where(array('id' => '[0-9]+'));
Route::post('/member/update', 'MemberController@update')->name('member.update');
Route::get('/member/destroy/{id}', 'MemberController@destroy')->name('member.destroy')->where(array('id' => '[0-9]+'));

Route::get('/bids', 'BidController@index')->name('bids');
Route::get('/bids/confirmed', 'BidController@confirmed')->name('bids.confirmed');
Route::post('/bid/update', 'BidController@update')->name('bid.update');

Route::get('/activities', 'ActivityController@index')->name('activities');
Route::get('/activity/add', 'ActivityController@create')->name('activity.add');
Route::post('/activity/store', 'ActivityController@store')->name('activity.store');
Route::get('/activity/edit/{id}', 'ActivityController@edit')->name('activity.edit')->where(array('id' => '[0-9]+'));
Route::post('/activity/update', 'ActivityController@update')->name('activity.update');
Route::get('/activity/destroy/{id}', 'ActivityController@destroy')->name('activity.destroy')->where(array('id' => '[0-9]+'));

Route::get('/activity-types', 'ActivityTypeController@index')->name('activity-types');
Route::get('/activity-type/add', 'ActivityTypeController@create')->name('activity-type.add');
Route::post('/activity-type/store', 'ActivityTypeController@store')->name('activity-type.store');
Route::get('/activity-type/edit/{id}', 'ActivityTypeController@edit')->name('activity-type.edit')->where(array('id' => '[0-9]+'));
Route::post('/activity-type/update', 'ActivityTypeController@update')->name('activity-type.update');
Route::get('/activity-type/destroy/{id}', 'ActivityTypeController@destroy')->name('activity-type.destroy')->where(array('id' => '[0-9]+'));
Route::post('/activity-type/availability', 'ActivityTypeController@availability')->name('activity-type.availability');

Route::get('/top-bids', 'TopBidController@index')->name('top.bids');
Route::get('/top-bid/add', 'TopBidController@create')->name('top.bid.add');
Route::post('/top-bid/store', 'TopBidController@store')->name('top-bid.store');
Route::get('/top-bid/edit/{id}', 'TopBidController@edit')->name('top-bid.edit')->where(array('id' => '[0-9]+'));
Route::post('/top-bid/update', 'TopBidController@update')->name('top-bid.update');
Route::get('/top-bid/destroy/{id}', 'TopBidController@destroy')->name('top-bid.destroy')->where(array('id' => '[0-9]+'));