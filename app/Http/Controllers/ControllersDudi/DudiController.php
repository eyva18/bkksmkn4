<?php

namespace App\Http\Controllers\ControllersDudi;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\JurusanModel;
use App\Models\TahunLulusModel;

class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $sekilasalumni = AlumniModel::paginate(6);
        $lowongandudi = LowonganModel::where('id_dudi', $dataUser->id)->paginate(6);
        return view('layout.dudi.layout', [
            'dataDudi' => $dataUser,
            'sekilasalumni' => $sekilasalumni,
            'lowongandudi' => $lowongandudi,
            'jurusan' => JurusanModel::all(),
            'tahunlulus' => TahunLulusModel::all(),
        ]);        
    }
    public function daftaralumni()
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $Alumnidata = AlumniModel::paginate(12);
        return view('layout.dudi.layout', [
            'dataDudi' => $dataUser,
            'Alumnidata' => $Alumnidata,
            'jurusan' => JurusanModel::all(),
            'tahunlulus' => TahunLulusModel::all(),
        ]);        
    }
    public function daftarlowongan()
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $lowongandudi = LowonganModel::where('id_dudi', $dataUser->id)->paginate(6);
        $alldudilowongan = LowonganModel::where('id_dudi', '!=', $dataUser->id)->paginate(6);
        return view('layout.dudi.layout', [
            'dataDudi' => $dataUser,
            'lowongandudi' => $lowongandudi,
            'alllowongan' => $alldudilowongan,
            'kategori' => CategoryModel::all(),
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
