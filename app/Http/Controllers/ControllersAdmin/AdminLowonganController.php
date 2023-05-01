<?php

namespace app\Http\Controllers\ControllersAdmin;

use App\Models\DudiModel;
use App\Models\LowonganModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLowonganController extends Controller
{
    public function job()
    {
        //Jurusan Database Function
        $datalowongan = LowonganModel::with('dudi')->with('kategori')->paginate(10);
        return view('admin.daftar.lowongan.job', [
            "datalowongan" => $datalowongan,
        ]);
    }
    public function job_search(Request $request)
    {
        //Jurusan Database Function
        $datalowongan = LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10);
        return view('admin.daftar.lowongan.job', [
            "datalowongan" => $datalowongan,
        ]);
    }
    public function job_delete(Request $request) 
    {
        LowonganModel::find($request->id)->delete();
        return back();
    }
    public function job_detail($dudi, LowonganModel $lowongan)
    {   
        //Jurusan Database Function
        $datalowongan = LowonganModel::where('id', $lowongan->id)->with('dudi')->with('kategori')->first();
        $userdudi = User::where('kode_owner', $datalowongan->dudi->id)->first();
        return view('admin.daftar.lowongan.detailjob', [
            "datalowongan" => $datalowongan,
            "datauser" => $userdudi
        ]);
    }
}
