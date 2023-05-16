<?php

namespace App\Http\Controllers\ControllersAlumni;

use App\Models\DudiModel;
use App\Models\AlumniModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LowonganModel;
use App\Models\ProfileAlumni;
use App\Models\RiwayatAlumniModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatPekerjaanModel;
use Illuminate\Auth\Events\Validated;
use App\Models\RiwayatPendidikanModel;

class ProfileAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Data Alumni
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
        $dataPendidikan = RiwayatPendidikanModel::where('user_id', Auth()->user()->id)->get();
        $dataPekerjaan = RiwayatPekerjaanModel::where('user_id', Auth()->user()->id)->get();

        //Count Lowongan Kerja
        $datadudi = DudiModel::paginate(3);
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.dashboard', [
                'dataAlumni' => $dataAlumni,
                'dataPendidikan' => $dataPendidikan,
                'dataPekerjaan' => $dataPekerjaan,
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        }
    }

    public function daftarLowongan()
    {
        $datadudi = DudiModel::paginate(3);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        }
    }

    public function daftarLowongansearch(Request $request)
    {
        $datadudi = DudiModel::paginate(3);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if ($request->nama_lowongan == null and $request->category == "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        } elseif ($request->nama_lowongan != null and $request->category == "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        } elseif ($request->nama_lowongan != null and $request->category != "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        } elseif ($request->nama_lowongan == null and $request->category != "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan
            ]);
        }
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
    public function detaillowongan(LowonganModel $lowongan)
    {
        $datalowongan = LowonganModel::with('dudi')->with('kategori')->find($lowongan->id);
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlowongan.detaillowongan', [
                'datalowongan' => $datalowongan,
                'lowongansekilas' => LowonganModel::with('dudi')->with('kategori')->where('id', '!=', $lowongan->id)->paginate(3),
            ]);
        }
    }
    public function daftarPerusahaan()
    {
        $lowongandata = LowonganModel::paginate(3);
        $dudidata = DudiModel::paginate(10);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($dudidata as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlperusahaan.daftarperusahaan', [
                "lowongan" => $lowongandata,
                "perusahaan"=> $dudidata,
                "countlowongan" => $lowongan
            ]);
        }
    }
    public function perusahaansearch(Request $request)
    {
        $lowongandata = LowonganModel::paginate(3);
        $dudidata = DudiModel::where('nama', 'like', "%" . $request->nama_perusahaan . "%")->paginate(10);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($dudidata as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlperusahaan.daftarperusahaan', [
                "lowongan" => $lowongandata,
                "perusahaan"=> $dudidata,
                "countlowongan" => $lowongan
            ]);
        }
        
    }
    public function profileperusahaan(DudiModel $dudi)
    {
        $dataperusahaan = DudiModel::with('userdata')->find($dudi->id);
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlperusahaan.profileperusahaan', [
                'dataperusahaan' => $dataperusahaan,
                'lowongan' => LowonganModel::where('id_dudi', $dudi->id)->with('kategori')->get()
            ]);
        }
    }
}
