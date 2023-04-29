<?php

namespace App\Http\Controllers;

use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\TahunLulusModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
        if($request->idjurusan == null and $request->idtahunlulus == null and $request->nama_alumni == null){
            $dataalumni = AlumniModel::with('jurusan')->with('tahunlulus')->get();
        }  
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus != "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusan', $request->idjurusan)->where('kode_lulus', $request->idtahunlulus)->get();
        }
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusan', $request->idjurusan)->get();
        }
        elseif($request->idtahunlulus != "Tahun Lulus" and $request->idjurusan == "Jurusan" ){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_lulus', $request->idtahunlulus)->get();
        }
        elseif($request->idjurusan == "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->get();
        }

        return view('admin.daftar.alumni.alumni', [
            "dataalumni" => $dataalumni,
            "datajurusan" => JurusanModel::all(),
            "datatahunlulus" => TahunLulusModel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AlumniModel $alumniModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlumniModel $alumniModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlumniModel $alumniModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, AlumniModel $alumniModel)
    {
        if($alumniModel->photo_profile) {
            Storage::delete($alumniModel->photo_profile);
        }

        AlumniModel::destroy($request->id);
<<<<<<< HEAD
=======

>>>>>>> 81a02ba79432498b7a9efd9a9e3ea09b0f6be80c
        return redirect('/admin/administrator/master/alumni');
    }
}
