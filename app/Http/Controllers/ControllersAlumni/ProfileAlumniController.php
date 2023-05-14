<?php

namespace App\Http\Controllers\ControllersAlumni;

use App\Models\AlumniModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProfileAlumni;
use App\Models\RiwayatAlumniModel;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use App\Models\RiwayatPendidikanModel;
use Illuminate\Support\Facades\Auth;

class ProfileAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $findSiswaProfile = Auth::user()->id;
        return view('alumni.dashboard', [
            'dataAlumni' => $findSiswaProfile
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
        $validasiDataRiwayatPendidikan = $request->validate([
            'nama_instansi' => 'string',
            'jenis_pendidikan' => 'required|in:1, 2, 3, 4, 5',
            'nilai_rata_rata' => 'numeric|decimal:0,100.00',
        ]);

        $validasiRiwayatPengalamanKerja = $request->validate([
            'nama_perusahaan' => '',
            'jenis_pekerjaan' => '',
            'bidang' => '',
            'awal_bekerja' => '',
            'akhir_bekerja' => '',
        ]);

        // $dataRiwayat = RiwayatAlumniModel::find($request->id);
        if ($validasiDataRiwayatPendidikan != null) {
            RiwayatPendidikanModel::create($validasiDataRiwayatPendidikan);
        } elseif ($validasiRiwayatPengalamanKerja != null) {
            RiwayatPendidikanModel::create($validasiRiwayatPengalamanKerja);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AlumniModel $alumniModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validasiDataBiografi = $request->validate([
            'biografi' => '',
        ]);
        
        // $validasiData['biografi'] = strip_tags($request->biografi);
        // dd($validasiData['biografi']);

        $dataBio = AlumniModel::find($request->id);
        AlumniModel::where('id', $dataBio->id)->update($validasiDataBiografi);
        return redirect('/alumni')->with('success', 'Biografi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
