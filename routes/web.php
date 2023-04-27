<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
//Test
Route::get('/test', function () {
    return view('admin.daftar.dudi.tambahdudi');
});

Route::get('/', function () {
    if(Auth::user() != null){
        return back();
    }
    elseif (Auth::user() == null) {
        return view('homepage.homepage');
    }
});
Auth::routes();
Route::get('/home', function () {
    if(Auth::user() == null){
        return redirect('/');
    }
    if(Auth::user()->hasRole('admin')){
        return redirect()->route('admin@dashboard');
    }
    elseif(Auth::user()->hasRole('alumni')){
        return redirect()->route('alumni@dashboard');
    }
    elseif(Auth::user()->hasRole('kepala_sekolah')){
        return redirect()->route('kepala_sekolah@dashboard');
    }
    elseif(Auth::user()->hasRole('dudi')){
        return redirect()->route('dudi@dashboard');
    }
});


//Route For Login-----------------------------------
Route::middleware('role:admin')->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin@dashboard');

Route::middleware('role:alumni')->get('/alumni/dashboard', function () {
    return 'Alumni Dashboard Here';
})->name('alumni@dashboard');

Route::middleware('role:kepala_sekolah')->get('/kepala-sekolah/dashboard', function () {
    return 'Kepala Sekolah Dashboard Here';
})->name('kepala_sekolah@dashboard');

Route::middleware('role:dudi')->get('/dudi/dashboard', function () {
    return 'Dudi Dashboard Here';
})->name('dudi@dashboard');
//Router For Login End


//Route Admin Here-----------------------------------
//Dapartement
Route::middleware('role:admin')->get('/admin/administrator/master/department',  [AdminController::class, 'dapartement'])->name('admin@master_dapartement');
Route::middleware('role:admin')->post('/admin/administrator/master/department/update',  [AdminController::class, 'dapartement_update']);
Route::middleware('role:admin')->post('/admin/administrator/master/department/newdata',  [AdminController::class, 'dapartement_add']);
Route::middleware('role:admin')->post('/admin/administrator/master/department/delete',  [AdminController::class, 'dapartement_delete']);
//Graduation Year
Route::middleware('role:admin')->get('/admin/administrator/master/graduation-year',  [AdminController::class, 'graduation_year'])->name('admin@master_graduation_year');
Route::middleware('role:admin')->post('/admin/administrator/master/graduation-year/update',  [AdminController::class, 'graduation_year_update']);
Route::middleware('role:admin')->post('/admin/administrator/master/graduation-year/newdata',  [AdminController::class, 'graduation_year_add']);
Route::middleware('role:admin')->post('/admin/administrator/master/graduation-year/delete',  [AdminController::class, 'graduation_year_delete']);
//Category Year
Route::middleware('role:admin')->get('/admin/administrator/master/category',  [AdminController::class, 'category'])->name('admin@master_category');
Route::middleware('role:admin')->post('/admin/administrator/master/category/update',  [AdminController::class, 'category_update']);
Route::middleware('role:admin')->post('/admin/administrator/master/category/newdata',  [AdminController::class, 'category_add']);
Route::middleware('role:admin')->post('/admin/administrator/master/category/delete',  [AdminController::class, 'category_delete']);
//Company Year
Route::middleware('role:admin')->get('/admin/administrator/master/company',  [AdminController::class, 'dudi'])->name('admin@master_company');
Route::middleware('role:admin')->post('/admin/administrator/master/company/update',  [AdminController::class, 'dudi_update']);
Route::middleware('role:admin')->get('/admin/administrator/master/company/create',  [AdminController::class, 'dudi_create']);
Route::middleware('role:admin')->post('/admin/administrator/master/company/newdata',  [AdminController::class, 'dudi_add']);
Route::middleware('role:admin')->post('/admin/administrator/master/company/delete',  [AdminController::class, 'dudi_delete']);
Route::middleware('role:admin')->get('/admin/administrator/master/company/search',  [AdminController::class, 'dudi_search']);


