<?php

namespace App\Http\Controllers;

use App\Models\AlumniModel;
use App\Models\CategoryModel;
use App\Models\DudiModel;
use App\Models\JurusanModel;
use App\Models\LowonganModel;
use App\Models\TahunLulusModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard', [
            'totalAlumni' => AlumniModel::count()
        ]);
    }

    //Dapartement Function Here ------------------------------
    public function dapartement()
    {
        //Jurusan Database Function
        $originaljurusan = JurusanModel::all();
        //Data Foward Function
        $datajurusanalumni = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_jurusan', $original->id)->count();
            $datajurusanalumni[$original->id] = $yz;
        }
        return view('admin.master-page.department', [
            "datajurusanalumni" => $datajurusanalumni,
            "datajurusan" => $originaljurusan
        ]);
    }
    public function dapartement_update(Request $request)
    {
        JurusanModel::find($request->id)->update([
            'jurusan' => $request->jurusan,
        ]);
        return back();
    }
    public function dapartement_add(Request $request)
    {
        $input = $request->all();
        JurusanModel::create($input);
        return back();
    }
    public function dapartement_delete(Request $request)
    {
        JurusanModel::find($request->id)->delete();
        return back();
    }

    //Geaduation Year Function Here ------------------------------
    public function graduation_year()
    {
        //Jurusan Database Function
        $originaltahunlulusan = TahunLulusModel::all();
        //Data Foward Function
        $datatahunlulusanalumni = [];
        foreach ($originaltahunlulusan as $original) {
            $yz = AlumniModel::where('kode_lulus', $original->id)->count();
            $datatahunlulusanalumni[$original->id] = $yz;
        }
        return view('admin.master-page.graduation-year', [
            "datatahunlulusanalumni" => $datatahunlulusanalumni,
            "datatahunlulusan" => $originaltahunlulusan
        ]);
    }
    public function graduation_year_update(Request $request)
    {
        TahunLulusModel::find($request->id)->update([
            'tahun_lulus' => $request->tahun_lulus,
        ]);
        return back();
    }
    public function graduation_year_add(Request $request)
    {
        $input = $request->all();
        TahunLulusModel::create($input);
        return back();
    }
    public function graduation_year_delete(Request $request)
    {
        TahunLulusModel::find($request->id)->delete();
        return back();
    }
    //Category Function Here ------------------------------
    public function category()
    {
        //Jurusan Database Function
        $datacategory = CategoryModel::all();
        return view('admin.master-page.category', [
            "datacategory" => $datacategory
        ]);
    }
    public function category_update(Request $request)
    {
        CategoryModel::find($request->id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return back();
    }
    public function category_add(Request $request)
    {
        $input = $request->all();
        CategoryModel::create($input);
        return back();
    }
    public function category_delete(Request $request)
    {
        CategoryModel::find($request->id)->delete();
        return back();
    }

    //Dudi Function Here ------------------------------
    public function dudi()
    {
        //Jurusan Database Function
        $datadudi = DudiModel::all();
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        return view('admin.daftar.dudi.dudi', [
            "datadudi" => $datadudi,
            "lowongan" => $lowongan
        ]);
    }
    public function dudi_create()
    {

        return view('admin.daftar.dudi.tambahdudi', ['bidangdata' => CategoryModel::all()]);
    }
    public function dudi_update(Request $request)
    {
        DudiModel::find($request->id)->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return back();
    }
    public function dudi_add(Request $request)
    {
        $number = 1000;
        for ($z1 = 1; $z1 <= $number; $z1++) {
            $getlatest = DudiModel::count();
            $idset = $getlatest + $z1;
            $cekid = DudiModel::find($idset);
            if ($cekid == null) {
                $fixidcreate = $idset;
                $z1 = 1000;
            }
        }
        $logo = null;
        if ($image = $request->file('logo')) {
            $destinationPath = 'images/profileimg/';
            $logoimage = $fixidcreate . "%" . $image->getClientOriginalName();
            $image->move($destinationPath, $logoimage);
            $logo = "$logoimage";
        } else {
        }
        DudiModel::create([
            'id' => $fixidcreate,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'no_telp' => $request->no_telp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'logo' => $logo,
        ]);
        $userdudi = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'kode_owner' => $fixidcreate,
            'photo_profile' => $logo
        ]);
        $userdudi->assignRole('dudi');
        return redirect()->route('admin@master_company');
    }
    public function dudi_delete(Request $request)
    {
        $data = DudiModel::find($request->id);
        $imagename = $data->logo;
        $image1 = $imagename;
        File::delete(public_path("images/profileimg/$image1"));
        DudiModel::find($request->id)->delete();
        User::where('kode_owner', $request->id)->delete();
        return back();
    }
    public function dudi_search(Request $request)
    {
        //Jurusan Database Function
        $datadudi = DudiModel::where('nama', 'like', "%" . $request->nama_perusahaan . "%")->get();
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        return view('admin.daftar.dudi.dudi', [
            "datadudi" => $datadudi,
            "lowongan" => $lowongan
        ]);
    }
    public function dudi_profile($dudi, Request $request)
    {
        //Jurusan Database Function
        $datadudi = DudiModel::find($request->id);
        //Count Lowongan Kerja
        $lowongan = LowonganModel::where('id_dudi', $request->id)->with('dudi')->with('kategori')->get();
        return view('admin.daftar.dudi.profiledudi', [
            "datadudi" => $datadudi,
            "lowongan" => $lowongan
        ]);
    }

    //Alumni Function Here ------------------------------
    public function alumni()
    {
        //Jurusan Database Function
    }
    
}
