<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Models\User;

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

Route::get('/', function () {
    return view('welcome');
});

/////          Admin Related Route          /////

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::group(
    ['prefix' => '/admin', 'middleware' => ['auth:admin']],
    function () {
        Route::middleware(['auth:sanctum,admin', 'verified'])->get('/dashboard', function () {
            return view('admin.index');
        })->name('dashboard');


        Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
        Route::get('/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
        Route::get('/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
        Route::post('/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
        Route::get('/change-password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
        Route::post('/update-password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.update.password');

        ///////       Brand related route        ///////

        Route::group(['prefix' => '/brand'], function () {
            Route::get('/all-brand', [BrandController::class, 'showAllBrand'])->name('all.brand');
            Route::post('/create-brand', [BrandController::class, 'createBrand'])->name('brand.create');
            Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
            Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
            Route::get('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');
        });

        ///////       Brand related route ended        ///////

        ///////       Category related route        ///////

        Route::group(['prefix' => '/category'], function () {
            Route::get('/all-category', [CategoryController::class, 'allCategory'])->name('all.category');
            Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('create.category');
            Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
            Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
            Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
        });

        ///////       Category related route ended        ///////

        ///////       Category related route        ///////

        Route::group(['prefix' => '/category'], function () {
            Route::get('/all-category', [SubCategoryController::class, 'allSubCategory'])->name('all.category');
            Route::post('/create-category', [SubCategoryController::class, 'createSubCategory'])->name('create.category');
            Route::get('/edit-category/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit.category');
            Route::post('/update-category/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('update.category');
            Route::get('/delete-category/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('delete.category');
        });

        ///////       Category related route ended        ///////
    }
);













/////          User All Route          /////


Route::get('/', [IndexController::class, 'index']);

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::findOrFail($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::group(
    ['prefix' => '/user', 'middleware' => ['auth:web']],
    function () {
        Route::get('/logout', [IndexController::class, 'userLogout'])->name('user.logout');
        Route::get('/profile', [IndexController::class, 'userProfile'])->name('user.profile');
        Route::post('/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
        Route::get('/change-password', [IndexController::class, 'userPChangePassword'])->name('change.password');
        Route::post('/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');
    }
);
