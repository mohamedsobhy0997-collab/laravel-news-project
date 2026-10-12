<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Psssword\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Psssword\ResetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Posts\PostsController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UsersController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//auth admin routes
Route::group(['prefix'=>'admin', 'as'=>'admin.' ], function(){
    Route::controller(LoginController::class)->group(function(){
        Route::get('login', 'showLoginform')->name('login.show');
        Route::post('login/check', 'checkAuth')->name('login.check');
        Route::post('logout', 'logout')->name('logout');

    });
    Route::group(['prefix'=>'password' , 'as'=>'password.'], function(){
        Route::controller(ForgetPasswordController::class)->group(function(){
        Route::get('email', 'showEmailform')->name('email');
        Route::post('email', 'sendOtp')->name('sendotp');
        Route::get('verify/{email}', 'showOtoForm')->name('showOtoform');
        Route::post ('verify', 'verifyOtp')->name('verifyOtp');


        });
       Route::controller(ResetPasswordController::class)->group(function(){
        Route::get('reset/{email}', 'showResetForm')->name('resetform');
        Route::post('reset', 'resetPassword')->name('reset');


       });
       


    });

});


Route::group(['prefix'=>'admin', 'as'=>'admin.' , 'middleware'=>'auth:admin'], function(){
     
Route::resource('authorizations', AuthorizationController::class );
Route::resource('admins', AdminController::class );
Route::get('admins/status/{id}',[AdminController::class, 'changeStatus'])->name('admins.changeStatus');

Route::resource('users', UsersController::class);
Route::get('users/status/{id}',[UsersController::class, 'changeStatus'])->name('users.changeStatus');

Route::resource('categories', CategoryController::class);
Route::get('categories/status/{id}',[CategoryController::class, 'changeStatus'])->name('categories.changeStatus');

Route::resource('posts',PostsController::class);
Route::get('posts/status/{id}',[PostsController::class, 'changeStatus'])->name('posts.changeStatus');
Route::post('posts/image/delete/{image_id}',[PostsController::class, 'deletePostImage'])->name('posts.delete.image');

//******Setting Routes *///
Route::controller(SettingController::class)->prefix('setting')->as('setting.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/update', 'update')->name('update');
});


Route::get('home',function(){
return view('admin.index');
})->name('home');
});




