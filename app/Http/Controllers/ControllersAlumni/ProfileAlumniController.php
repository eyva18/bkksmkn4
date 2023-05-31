<?php

namespace App\Http\Controllers\ControllersAlumni;

use App\Models\User;
use App\Models\DudiModel;
use App\Models\AgamaModel;
use App\Models\AlumniModel;
use Illuminate\Support\Str;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\LowonganModel;
use Illuminate\Support\Carbon;
use App\Models\TahunLulusModel;
use App\Models\SertifikasiModel;
use App\Models\JenisKelaminModel;
use App\Models\JenisPekerjaanModel;
use App\Http\Controllers\Controller;
use App\Models\JenisPendidikanModel;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatPekerjaanModel;
use App\Models\SertifikasiLombaModel;
use App\Models\RiwayatPendidikanModel;
use App\Models\StatusAlumniModel;
use App\Models\StatusBekerjaModel;
use App\Models\StatusPendidikanModel;
use App\Models\TingkatPerlombaanModel;
use Illuminate\Support\Facades\Storage;

class ProfileAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data Alumni
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
        $dataStatusAlumni = StatusAlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataStatusAlumni as $data) {
            $dataStatusA = $data;
        }
        $dataPendidikan = RiwayatPendidikanModel::where('user_id', Auth()->user()->id)->get();
        $dataPekerjaan = RiwayatPekerjaanModel::where('user_id', Auth()->user()->id)->get();
        $dataSertifikasi = SertifikasiModel::where('user_id', Auth()->user()->id)->get();
        $dataSertifikasiLomba = SertifikasiLombaModel::where('user_id', Auth()->user()->id)->get();

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
                'dataStatusAlumni' => $dataStatusA,
                'dataPendidikan' => $dataPendidikan,
                'dataPekerjaan' => $dataPekerjaan,
                'dataSertifikasi' => $dataSertifikasi,
                'dataSertifikasiLomba' => $dataSertifikasiLomba,
                'dataJenisPendidikan' => JenisPendidikanModel::all(),
                'dataJenisPekerjaan' => JenisPekerjaanModel::all(),
                'dataTingkatPerlombaan' => TingkatPerlombaanModel::all(),
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all()
            ]);
        }
    }

    public function daftarLowongan()
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
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
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataAlumni' => $dataAlumni,
            ]);
        }
    }

    public function daftarLowongansearch(Request $request)
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
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
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataAlumni' => $dataAlumni,

            ]);
        } elseif ($request->nama_lowongan != null and $request->category == "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataAlumni' => $dataAlumni,

            ]);
        } elseif ($request->nama_lowongan != null and $request->category != "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataAlumni' => $dataAlumni,

            ]);
        } elseif ($request->nama_lowongan == null and $request->category != "Spesialis Pekerjaan") {
            return view('alumni.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataAlumni' => $dataAlumni,

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

    public function riwayatpendidikan_store(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_instansi' => 'string',
            'jenis_pendidikan' => 'in:1, 2, 3, 4, 5',
            'nilai_rata_rata' => 'numeric|decimal:0,100.00',
            'tahun_awal_pendidikan' => 'date',
            'tahun_akhir_pendidikan' => '',
        ]);

        $tanggalAwal = $validasiData['tahun_awal_pendidikan'];
        $validasiData['tahun_awal_pendidikan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pendidikan'])->format('l, j F Y');
        
        if ($request->tahun_akhir_pendidikan != null) {
            $tanggalAkhir = $validasiData['tahun_akhir_pendidikan'];
            $validasiData['tahun_akhir_pendidikan'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_akhir_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pendidikan'])->format('l, j F Y');
        } else {
            $validasiData['tahun_akhir_pendidikan'] = 'Masih bersekolah sampai sekarang';
        }

        $findUser = User::findOrFail($dataAlumni->user_id);
        $validasiData['user_id'] = $findUser->id;

        RiwayatPendidikanModel::create($validasiData);
        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan');
    }

    public function riwayatpekerjaan_store(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_perusahaan' => 'string',
            'jenis_pekerjaan' => 'in:1, 2, 3, 4, 5',
            'bidang' => 'string',
            'tahun_awal_pekerjaan' => 'date',
            'tahun_akhir_pekerjaan' => '',
        ]);

        $tanggalAwal = $validasiData['tahun_awal_pekerjaan'];
        $validasiData['tahun_awal_pekerjaan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pekerjaan'])->format('l, j F Y');
        
        if ($request->tahun_akhir_pekerjaan != null) {
            $tanggalAkhir = $validasiData['tahun_akhir_pekerjaan'];
            $validasiData['tahun_akhir_pekerjaan'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_akhir_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pekerjaan'])->format('l, j F Y');
        } else {
            $validasiData['tahun_akhir_pekerjaan'] = 'Masih bekerja sampai sekarang';
        }

        $findUser = User::findOrFail($dataAlumni->user_id);
        $validasiData['user_id'] = $findUser->id;
        // dd($validasiData);
        RiwayatPekerjaanModel::create($validasiData);
        return back()->with('success', 'Riwayat pekerjaan berhasil ditambahkan');
    }

    public function sertifikasi_store(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nama_sertifikasi' => 'string',
            'nama_penerbit' => 'string',
            'tahun_terbit' => 'date',
            'tahun_kadaluarsa' => '',
            'kode_sertifikasi' => 'required',
            'link_sertifikasi' => '',
            'file_sertifikasi' => 'required|image|mimes:jpeg,jpg,|max:2048',
        ]);
        
        $tanggalAwal = $validasiData['tahun_terbit'];
        $validasiData['tahun_terbit'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_terbit'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_terbit'])->format('l, j F Y');
        
        if ($request->tahun_kadaluarsa != null) {
            $tanggalAkhir = $validasiData['tahun_kadaluarsa'];
            $validasiData['tahun_kadaluarsa'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_kadaluarsa'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_kadaluarsa'])->format('l, j F Y');
        } else {
            $validasiData['tahun_kadaluarsa'] = 'Sampai Sekarang';
        }

        if($request->file('file_sertifikasi')) {
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->getClientOriginalName();
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->storeAs('file_sertifikasi_Alumni', $validasiData['file_sertifikasi']);
        }

        $findUser = User::findOrFail($dataAlumni->user_id);
        $validasiData['user_id'] = $findUser->id;
        // dd($validasiData);

        SertifikasiModel::create($validasiData);
        return back()->with('success', 'Sertifikasi Berhasil Ditambahkan!');
    }

    public function sertifikasilomba_store(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nama_juara_kompetensi' => 'string',
            'tingkat_perlombaan' => 'in:1,2,3,4,5',
            'tanggal_terbit' => 'date',
            'tanggal_kadaluarsa' => '',
            'file_sertifikasi' => 'required|image|mimes:jpeg,jpg,|max:2048',
        ]);
        
        $tanggalAwal = $validasiData['tanggal_terbit'];
        $validasiData['tanggal_terbit'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tanggal_terbit'] = Carbon::createFromFormat('d/m/Y', $validasiData['tanggal_terbit'])->format('l, j F Y');
        
        if ($request->tanggal_kadaluarsa != null) {
            $tanggalAkhir = $validasiData['tanggal_kadaluarsa'];
            $validasiData['tanggal_kadaluarsa'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tanggal_kadaluarsa'] = Carbon::createFromFormat('d/m/Y', $validasiData['tanggal_kadaluarsa'])->format('l, j F Y');
        } else {
            $validasiData['tanggal_kadaluarsa'] = 'Sampai Sekarang';
        }
        
        if($request->file('file_sertifikasi')) {
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->getClientOriginalName();
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->storeAs('file_sertifikasi_Lomba_Alumni', $validasiData['file_sertifikasi']);
        }

        $findUser = User::findOrFail($dataAlumni->user_id);
        $validasiData['user_id'] = $findUser->id;
        // dd($validasiData);

        SertifikasiLombaModel::create($validasiData);
        return back()->with('success', 'Sertifikasi Berhasil Ditambahkan!');
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
    public function update_biografi(Request $request) {
        $validasiDataBiografi = $request->validate([
            'biografi' => '',
        ]);
        // $validasiData['biografi'] = strip_tags($request->biografi);
        
        $dataBio = AlumniModel::find($request->id);
        AlumniModel::where('id', $dataBio->id)->update($validasiDataBiografi);
        return back()->with('success', 'Biografi berhasil diubah');
    }

    public function riwayatpendidikan_update(Request $request, RiwayatPendidikanModel $riwayatPendidikanModel) {
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_instansi' => 'string',
            'jenis_pendidikan' => 'in:1, 2, 3, 4, 5',
            'nilai_rata_rata' => 'numeric|decimal:0,100.00',
            'tahun_awal_pendidikan' => 'date',
            'tahun_akhir_pendidikan' => '',
        ]);

        $tanggalAwal = $validasiData['tahun_awal_pendidikan'];
        $validasiData['tahun_awal_pendidikan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pendidikan'])->format('l, j F Y');
        if ($request->tahun_akhir_pendidikan) {
            $tanggalAkhir = $validasiData['tahun_akhir_pendidikan'];
            $validasiData['tahun_akhir_pendidikan'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_akhir_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pendidikan'])->format('l, j F Y');
        } else {
            $validasiData['tahun_akhir_pendidikan'] = 'Masih bersekolah sampai sekarang';
        }

        RiwayatPendidikanModel::find($request->id)->update($validasiData);
        return back()->with('success', 'Riwayat pendidikan berhasil diubah');
    }

    public function riwayatpekerjaan_update(Request $request) {
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_perusahaan' => 'string',
            'jenis_pekerjaan' => 'in:1, 2, 3, 4, 5',
            'bidang' => 'string',
            'tahun_awal_pekerjaan' => 'date',
            'tahun_akhir_pekerjaan' => '',
        ]);
        $tanggalAwal = $validasiData['tahun_awal_pekerjaan'];
        $validasiData['tahun_awal_pekerjaan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pekerjaan'])->format('l, j F Y');
        
        if ($request->tahun_akhir_pekerjaan != null) {
            $tanggalAkhir = $validasiData['tahun_akhir_pekerjaan'];
            $validasiData['tahun_akhir_pekerjaan'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_akhir_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pekerjaan'])->format('l, j F Y');
        } else {
            $validasiData['tahun_akhir_pekerjaan'] = 'Masih bekerja sampai sekarang';
        }
        // dd($validasiData['tahun_akhir_pekerjaan']);
        
        RiwayatPekerjaanModel::findOrFail($request->id)->update($validasiData);
        return back()->with('success', 'Riwayat pekerjaan berhasil diubah');
    }

    public function sertifikasi_update(Request $request) {
        $validasiData = $request->validate([
            'nama_sertifikasi' => 'string',
            'nama_penerbit' => 'string',
            'tahun_terbit' => 'date',
            'tahun_kadaluarsa' => '',
            'kode_sertifikasi' => 'required',
            'link_sertifikasi' => '',
            'file_sertifikasi' => 'image|mimes:jpeg,jpg,|max:2048',
        ]);
        
        $tanggalAwal = $validasiData['tahun_terbit'];
        $validasiData['tahun_terbit'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_terbit'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_terbit'])->format('l, j F Y');
        
        if ($request->tahun_kadaluarsa) {
            $tanggalAkhir = $validasiData['tahun_kadaluarsa'];
            $validasiData['tahun_kadaluarsa'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tahun_kadaluarsa'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_kadaluarsa'])->format('l, j F Y');
        } else {
            $validasiData['tahun_kadaluarsa'] = 'Sampai Sekarang';
        }
        
        $validasiData['file_sertifikasi'] = $request->oldSertifikasi;

        if($request->file('file_sertifikasi')) {
            if($request->oldSertifikasi) {
                Storage::delete($request->oldSertifikasi);
            }
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->getClientOriginalName();
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->storeAs('file_sertifikasi_Alumni', $validasiData['file_sertifikasi']);
        }

        // dd($validasiData);
        SertifikasiModel::find($request->id)->update($validasiData);
        return back()->with('success', 'Sertifikasi Berhasil Diubah!');
    }

    
    public function sertifikasilomba_update(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nama_juara_kompetensi' => 'string',
            'tingkat_perlombaan' => 'in:1,2,3,4,5',
            'tanggal_terbit' => 'date',
            'tanggal_kadaluarsa' => '',
            'file_sertifikasi' => 'image|mimes:jpeg,jpg,|max:2048',
        ]);
        
        $tanggalAwal = $validasiData['tanggal_terbit'];
        $validasiData['tanggal_terbit'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tanggal_terbit'] = Carbon::createFromFormat('d/m/Y', $validasiData['tanggal_terbit'])->format('l, j F Y');
        
        if ($request->tanggal_kadaluarsa) {
            $tanggalAkhir = $validasiData['tanggal_kadaluarsa'];
            $validasiData['tanggal_kadaluarsa'] = date('d/m/Y', strtotime($tanggalAkhir));
            $validasiData['tanggal_kadaluarsa'] = Carbon::createFromFormat('d/m/Y', $validasiData['tanggal_kadaluarsa'])->format('l, j F Y');
        } else {
            $validasiData['tanggal_kadaluarsa'] = 'Sampai Sekarang';
        }
        
        $validasiData['file_sertifikasi'] = $request->oldSertifikasi;

        if($request->file('file_sertifikasi')) {
            if($request->oldSertifikasi) {
                Storage::delete($request->oldSertifikasi);
            }
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->getClientOriginalName();
            $validasiData['file_sertifikasi'] = $request->file('file_sertifikasi')->storeAs('file_sertifikasi_Lomba_Alumni', $validasiData['file_sertifikasi']);
        }
        // dd($validasiData);

        SertifikasiLombaModel::find($request->id)->update($validasiData);
        return back()->with('success', 'Sertifikasi Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

    public function riwayatpendidikan_destroy(Request $request) {
        RiwayatPendidikanModel::destroy($request->id);
        return back()->with('success', 'Data Riwayat Pendidikan Berhasil Dihapus');
    }

    public function riwayatpekerjaan_destroy(Request $request) {
        RiwayatPekerjaanModel::destroy($request->id);
        return back()->with('success', 'Data Riwayat Pekerjaan Berhasil Dihapus');
    }

    public function sertifikasi_destroy(Request $request) {
        SertifikasiModel::destroy($request->id);
        return back()->with('success', 'Data Sertifikat Berhasil Dihapus');
    }

    public function sertifikasilomba_destroy(Request $request) {
        SertifikasiLombaModel::destroy($request->id);
        return back()->with('success', 'Data Sertifikat Lomba Berhasil Dihapus');
    }

    public function detaillowongan(LowonganModel $lowongan)
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
        $datalowongan = LowonganModel::with('dudi')->with('kategori')->find($lowongan->id);
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlowongan.detaillowongan', [
                'datalowongan' => $datalowongan,
                'lowongansekilas' => LowonganModel::with('dudi')->with('kategori')->where('id', '!=', $lowongan->id)->paginate(3),
                'dataAlumni' => $dataAlumni,
            ]);
        }
    }
    public function daftarPerusahaan()
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
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
                "perusahaan" => $dudidata,
                "countlowongan" => $lowongan,
                'dataAlumni' => $dataAlumni,
            ]);
        }
    }
    public function perusahaansearch(Request $request)
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
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
                "perusahaan" => $dudidata,
                "countlowongan" => $lowongan,
                'dataAlumni' => $dataAlumni,
            ]);
        }
    }
    public function profileperusahaan(DudiModel $dudi)
    {
        $dataUser = AlumniModel::where('user_id', Auth()->user()->id)->get();
        foreach ($dataUser as $data) {
            $dataAlumni = AlumniModel::find($data->id);
        }
        $dataperusahaan = DudiModel::with('userdata')->find($dudi->id);
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.daftarlperusahaan.profileperusahaan', [
                'dataperusahaan' => $dataperusahaan,
                'lowongan' => LowonganModel::where('id_dudi', $dudi->id)->with('kategori')->paginate(4),
                'dataAlumni' => $dataAlumni,
            ]);
        }
    }
    public function alumniprofil(AlumniModel $alumni)
    {
        $dataAlumni = AlumniModel::find($alumni->id);
        $dataUser = User::findOrFail($dataAlumni->user_id);
        $dataStatusAlumni = StatusAlumniModel::find($dataAlumni->id);
        if (Auth::user()->hasRole('alumni')) {
            return view('alumni.profile', [
                'alumni' => $dataAlumni,
                'dataAlumni' => $dataAlumni,
                "dataUser" => $dataUser,
                'dataStatusAlumni' => $dataStatusAlumni,
                'dataStatusBekerja' => StatusBekerjaModel::all(),
                'dataStatusPendidikan' => StatusPendidikanModel::all(),
                'dataAgama' => AgamaModel::all(),
                'dataJenisKelamin' => JenisKelaminModel::all(),
                'dataJurusan' => JurusanModel::all(),
                'dataTahunLulus' => TahunLulusModel::all(),
            ]);
        }
    }
}
