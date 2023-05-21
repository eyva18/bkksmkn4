<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ControllersAdmin\AdminController;
use App\Http\Controllers\ControllersAdmin\AdminAlumniController;
use App\Http\Controllers\ControllersAdmin\AdminLowonganController;
use App\Http\Controllers\ControllersAlumni\ProfileAlumniController;
use App\Http\Controllers\ControllersAdmin\AdminLaporanTahunKelulusanController;
use App\Http\Controllers\ControllersDudi\DudiController;
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
            'dudi' => DudiModel::all()
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
Route::middleware(['auth', 'role:admin'])->group(function() {
    // Route::resource('/alumni', AdminAlumniController::class);
    Route::get('/alumni/', [AdminController::class, 'alumni_index']);
    Route::get('/alumni/create', [AdminController::class, 'alumni_create']);
    Route::get('/alumni/store', [AdminController::class, 'alumni_store']);
    Route::post('/alumni/pendidikan/store', [AdminController::class, 'riwayatpendidikan_store']);
    Route::post('/alumni/pekerjaan/store', [AdminController::class, 'riwayatpekerjaan_store']);
    Route::get('/alumni/{alumniModel:nama}/show', [AdminController::class, 'alumni_show']);
    Route::get('/alumni/{alumniModel:nama}/edit', [AdminController::class, 'alumni_edit']);
    Route::put('/alumni/{alumniModel:nama}/update', [AdminController::class, 'alumni_update']);
    Route::post('/alumni/biografi/update', [AdminController::class, 'update_biografi']);
    Route::post('/alumni/pendidikan/update', [AdminController::class, 'riwayatpendidikan_update']);
    Route::post('/alumni/pekerjaan/update', [AdminController::class, 'riwayatpekerjaan_update']);
    Route::post('/alumni/{alumniModel:nama}/destroy', [AdminController::class, 'alumni_destroy']);

    Route::post('/alumni/pendidikan/delete', [AdminController::class, 'riwayatpendidikan_destroy']);
    Route::post('/alumni/pekerjaan/delete', [AdminController::class, 'riwayatpekerjaan_destroy']);
});

Route::middleware(['auth', 'role:admin|alumni'])->group(function() {
    Route::resource('/alumni/profile', ProfileAlumniController::class);
    Route::get('/lowongan-kerja', [ProfileAlumniController::class, 'daftarLowongan']);
    Route::get('/lowongan-kerja/search+', [ProfileAlumniController::class, 'daftarLowongansearch']);
    Route::get('/lowongan-kerja/detail/{lowongan:nama}', [ProfileAlumniController::class, 'detaillowongan']);

    Route::get('/daftar-perusahaan', [ProfileAlumniController::class, 'daftarPerusahaan']);
    Route::get('/daftar-perusahaan/search+', [ProfileAlumniController::class, 'perusahaansearch']);
    Route::get('/perusahaan/profile/{dudi:nama}', [ProfileAlumniController::class, 'profileperusahaan']);

    Route::get('/profile/{alumni:nama}', [ProfileAlumniController::class, 'alumniprofil']);
    Route::post('/profile/riwayat-pendidikan/store', [ProfileAlumniController::class, 'riwayatpendidikan_store']);
    Route::post('/profile/riwayat-pekerjaan/store', [ProfileAlumniController::class, 'riwayatpekerjaan_store']);
    Route::put('/profile/{alumniModel:nama}/update', [AdminController::class, 'alumni_update']);
    Route::post('/profile/biografi/update', [ProfileAlumniController::class, 'update_biografi']);
});

Route::middleware(['auth', 'role:dudi'])->group(function() {
    Route::get('/company/dashboard', [DudiController::class, 'index'])->name('dudi@dashboard');
    Route::post('/company/biografi/update', [DudiController::class, 'update_deskripsi']);
    Route::get('/company/daftar-alumni', [DudiController::class, 'daftaralumni']);
    Route::get('/alumni/search+', [DudiController::class, 'alumnisearch']);
    Route::get('/company/alumni/profile-detail/{alumni:nama}', [DudiController::class, 'alumniprofile']);
    Route::get('/company/daftar-lowongan', [DudiController::class, 'daftarlowongan']);
    Route::get('/company/lowongan/create', [DudiController::class, 'lowongancreate']);
    Route::get('/company/daftar-lowongan/search+', [DudiController::class, 'dudisearch']);
    Route::post('/company/lowongan/{dudi:nama}/new', [DudiController::class, 'lowonganstore']);
    Route::post('/company/lowongan/delete', [DudiController::class, 'lowongandelete']);
    Route::get('/company/lowongan-kerja/detail/{lowongan:nama}', [DudiController::class, 'detaillowongan']);
    Route::get('/company/lowongan-kerja/edit/{lowongan:nama}', [DudiController::class, 'editlowongan']);
    Route::post('/company/lowongan-kerja/update/{lowongan:nama}', [DudiController::class, 'updatelowongan']);
    Route::get('/company/profile/{dudi:nama}', [DudiController::class, 'dudiprofile']);
    Route::put('/company/profile/{dudi:nama}/update', [DudiController::class, 'updateprofile']);


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
