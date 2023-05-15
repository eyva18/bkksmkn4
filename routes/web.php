<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllersAdmin\AdminController;
use App\Http\Controllers\ControllersAdmin\AdminAlumniController;
use App\Http\Controllers\ControllersAdmin\AdminLowonganController;
use App\Http\Controllers\ControllersAlumni\ProfileAlumniController;
use App\Http\Controllers\ControllersAdmin\AdminLaporanTahunKelulusanController;
use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\LowonganModel;

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
Route::get('/alumni-design', function () {
    return view('alumni.dashboard.dashboard');
});
Route::get('/test', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login.login');
});
Route::get('/', function () {
    if(Auth::user() != null){
        return back();
    }
    elseif (Auth::user() == null) {
        return view('homepage.homepage', [
            'totalAlumni' => AlumniModel::count(),
            'totalperusahaan' => DudiModel::count(),
            'totallowongan' => LowonganModel::count(),
        ]);
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

Route::middleware('role:alumni')->get('/dashboard', [ProfileAlumniController::class, 'index'])->name('alumni@dashboard');

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
Route::middleware('role:admin')->get('/admin/administrator/master/company/profile/{dudi:nama}',  [AdminController::class, 'dudi_profile']);
Route::middleware('role:admin')->get('/admin/administrator/master/company/edit/{dudi:nama}',  [AdminController::class, 'editdudi_profile']);

//Alumni Year
// Route::middleware('role:admin')->get('/admin/administrator/master/alumni',  [AdminController::class, 'alumni'])->name('admin@master_alumni');
// Route::middleware('role:admin')->post('/admin/administrator/master/alumni/profile/{dudi}',  [AdminController::class, 'alumni_profile']);
Route::middleware(['auth', 'role:admin'])->group(function() {
    // Route::resource('/alumni', AdminAlumniController::class);
    Route::get('/alumni/', [AdminAlumniController::class, 'index']);
    Route::get('/alumni/create', [AdminAlumniController::class, 'create']);
    Route::post('/alumni/store', [AdminAlumniController::class, 'store']);
    Route::post('/alumni/{alumniModel:nama}/show', [AdminAlumniController::class, 'show']);
    Route::post('/alumni/{alumniModel:nama}/store-pendidikan', [AdminController::class, '']);
    Route::post('/alumni/{alumniModel:nama}/store-pekerjaan', [AdminController::class, '']);
    Route::get('/alumni/{alumniModel:nama}/update-pendidikan', [AdminController::class, '']);
    Route::get('/alumni/{alumniModel:nama}/update-pekerjaan', [AdminController::class, '']);
    Route::get('/alumni/{alumniModel:nama}/edit', [AdminAlumniController::class, 'edit']);
    Route::put('/alumni/{alumniModel:nama}/update', [AdminAlumniController::class, 'update']);
    Route::post('/alumni/{alumniModel:nama}/destroy', [AdminAlumniController::class, 'destroy']);
});

Route::middleware(['auth', 'role:admin|alumni'])->group(function() {
    Route::resource('/alumni/profile', ProfileAlumniController::class);
    Route::get('/lowongan-kerja', [ProfileAlumniController::class, 'daftarLowongan']);
    Route::get('/lowongan-kerja/search+', [ProfileAlumniController::class, 'daftarLowongansearch']);
    Route::get('/lowongan-kerja/detail/{lowongan:nama}', [ProfileAlumniController::class, 'detaillowongan']);
    Route::get('/daftar-perusahaan', [ProfileAlumniController::class, 'daftarPerusahaan']);
    Route::get('/daftar-perusahaan/search+', [ProfileAlumniController::class, 'perusahaansearch']);
    Route::get('/perusahaan/profile/{dudi:nama}', [ProfileAlumniController::class, 'profileperusahaan']);
});


//Lowongan Kerja
Route::middleware('role:admin')->get('/admin/administrator/master/job',  [AdminLowonganController::class, 'job'])->name('admin@master_job');
Route::middleware('role:admin')->get('/admin/administrator/master/job/search',  [AdminLowonganController::class, 'job_search']);
Route::middleware('role:admin')->post('/admin/administrator/master/job/delete',  [AdminLowonganController::class, 'job_delete']);
Route::middleware('role:admin')->get('/admin/administrator/master/company/{dudi}/job/{lowongan:nama}',  [AdminLowonganController::class, 'job_detail']);


//Laporan Tahun Kelulusan
Route::middleware('role:admin')->get('/admin/administrator/master/report/yearly',  [AdminLaporanTahunKelulusanController::class, 'index'])->name('admin@master_laporanYearly');
Route::middleware('role:admin')->get('/admin/administrator/master/report/yeary/pick/',  [AdminLaporanTahunKelulusanController::class, 'laporan_yearly']);
Route::middleware('role:admin')->get('/admin/administrator/master/report/yearly/all/jurusan/{idjurusan}',  [AdminLaporanTahunKelulusanController::class, 'detail_laporan_perjurusan']);
Route::middleware('role:admin')->get('/admin/administrator/master/report/yearly/{tahun_lulus:tahun_lulus}/jurusan/{idjurusan}',  [AdminLaporanTahunKelulusanController::class, 'detail_laporan_perjurusan_pertahun']);
//Laporan Export Tahun Kelulusan
Route::middleware('role:admin')->get('/admin/administrator/master/report/yearly/all/jurusan/{idjurusan}/export',  [AdminLaporanTahunKelulusanController::class, 'detail_laporan_perjurusan_export']);
Route::middleware('role:admin')->get('/admin/administrator/master/report/yearly/{tahun_lulus:tahun_lulus}/jurusan/{idjurusan}/export',  [AdminLaporanTahunKelulusanController::class, 'detail_laporan_perjurusan_pertahun_export']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
