<?php

namespace App\Http\Controllers\ControllersDudi;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\LowonganModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\JurusanModel;
use App\Models\RiwayatPekerjaanModel;
use App\Models\RiwayatPendidikanModel;
use App\Models\SertifikasiLombaModel;
use App\Models\SertifikasiModel;
use App\Models\TahunLulusModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class DudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = DudiModel::with('userdata')->where('user_id', Auth()->user()->id)->first();
        $sekilasalumni = AlumniModel::with('jurusan')->with('Jenis_Kelamin')->with('tahunlulus')->paginate(6);
        $lowongandudi = LowonganModel::where('id_dudi', $dataUser->id)->paginate(2);
        return view('dudi.dashboard', [
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
        $Alumnidata = AlumniModel::paginate(9);
        return view('dudi.daftaralumni.daftarAlumni', [
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
        $alldudilowongan = LowonganModel::paginate(9);
        return view('dudi.daftarlowongan.daftarlowongan', [
            'dataDudi' => $dataUser,
            'lowongandudi' => $lowongandudi,
            'alllowongan' => $alldudilowongan,
            'category' => CategoryModel::all(),
        ]);        
    }
    public function alumniprofile(AlumniModel $alumni)
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $dataPendidikan = RiwayatPendidikanModel::where('user_id',  $alumni->user_id)->get();
        $dataPekerjaan = RiwayatPekerjaanModel::where('user_id',  $alumni->user_id)->get();
        $dataSertifikasi = SertifikasiModel::where('user_id',  $alumni->user_id)->get();
        $dataSertifikasiLomba = SertifikasiLombaModel::where('user_id',  $alumni->user_id)->get();
        return view('dudi.daftaralumni.alumniprofiledetail', [
            'dataDudi' => $dataUser,
            'dataAlumni' => $alumni,
            'dataPendidikan' => $dataPendidikan,
            'dataPekerjaan' => $dataPekerjaan,
            'dataSertifikasi' => $dataSertifikasi,
            'dataSertifikasiLomba' => $dataSertifikasiLomba,
            'alumnisekilas' => AlumniModel::where('id', '!=', $alumni->id)->paginate(3)
        ]);        
    }
    public function alumnisearch(Request $request){
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        if($request->idjurusan == null and $request->idtahunlulus == null and $request->nama_alumni == null){
            $dataalumni = AlumniModel::with('jurusan')->with('tahunlulus')->latest()->paginate(9);
        }  
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus != "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(9);
        }
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->latest()->paginate(9);
        }
        elseif($request->idtahunlulus != "Tahun Lulus" and $request->idjurusan == "Jurusan" ){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(9);
        }
        elseif($request->idjurusan == "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->latest()->paginate(9);
        }
        return view('dudi.daftaralumni.daftarAlumni', [
            'dataDudi' => $dataUser,
            "Alumnidata" => $dataalumni,
            "jurusan" => JurusanModel::all(),
            "tahunlulus" => TahunLulusModel::all()
        ]);
    }
    public function dudisearch(Request $request)
    {        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $lowongandudi = LowonganModel::where('id_dudi', $dataUser->id)->paginate(6);
        //Jurusan Database Function
        if($request->nama_lowongan == null AND $request->category == null){
        $alldudilowongan = LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10);
        }
        elseif($request->nama_lowongan != null AND $request->category != null){
            $alldudilowongan = LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->where('id_kategoti_pekerjaan', $request->category)->paginate(10);
        }
        elseif($request->nama_lowongan == null AND $request->category != null){
            $alldudilowongan = LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->where('id_kategoti_pekerjaan', $request->category)->paginate(10);
        }
        elseif($request->nama_lowongan == !null AND $request->category == null){
            $alldudilowongan = LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10);
        }
        return view('dudi.daftarlowongan.daftarlowongan', [
            'dataDudi' => $dataUser,
            'lowongandudi' => $lowongandudi,
            'alllowongan' => $alldudilowongan,
            'category' => CategoryModel::all(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function lowongancreate()
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        return view('dudi.daftarlowongan.tambahlowongan', [
            'dataDudi' => $dataUser,
            'category' => CategoryModel::all(),
        ]);        
    }
    public function editlowongan(LowonganModel $lowongan)
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        return view('dudi.daftarlowongan.editlowongan', [
            'dataDudi' => $dataUser,
            'datalowongan' => $lowongan,
            'category' => CategoryModel::all(),
        ]);        
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function lowonganstore(DudiModel $dudi,Request $request) {
        LowonganModel::create([
            'nama' => $request->nama,
            'deskripsi_pekerjaan' => $request->deskripsi,
            'deskripsi_perusahaan' => $dudi->deskripsi,
            'lokasi' => $request->lokasi,
            'id_kategoti_pekerjaan' => $request->id_kategoti_pekerjaan,
            'gaji' => $request->gaji,
            'tgl_upload' => now(),
            'id_dudi' => $request->iddudi,
        ]);
        return redirect('/company/lowongan-kerja/detail/'.$request->nama)->with('success', 'Lowongan telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function detaillowongan(LowonganModel $lowongan)
    {
        $dataUser = DudiModel::where('user_id', Auth()->user()->id)->first();
        $datalowongan = LowonganModel::with('dudi')->with('kategori')->find($lowongan->id);
        return view('dudi.daftarlowongan.detaillowongan', [
            'dataDudi' => $dataUser,
            'category' => CategoryModel::all(),
            'datalowongan' => $datalowongan,
        ]);        
    }
    public function dudiprofile(DudiModel $dudi)
    {
        $dataDudi = DudiModel::where('user_id', Auth()->user()->id)->first();
        return view('dudi.profile', [
            'dataDudi' => $dataDudi,
            'dataUser' => User::find(Auth()->user()->id)
        ]);        
    }
    public function lowongandelete(Request $request)
    {
        LowonganModel::find($request->id)->delete();
        return redirect('/company/daftar-lowongan')->with('successdelete', 'Lowongan Telah Dihapus');        
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
    public function update_deskripsi(Request $request) {
        DudiModel::where('id', $request->id)->update([
            'deskripsi' => $request->biografi
        ]);
        return back()->with('success', 'Biografi berhasil diubah');
    }
    public function updatelowongan(LowonganModel $lowongan, Request $request) {
        $dudi = DudiModel::find($lowongan->id_dudi);
        LowonganModel::find($lowongan->id)->update([
            'nama' => $request->nama,
            'deskripsi_pekerjaan' => $request->deskripsi,
            'deskripsi_perusahaan' => $dudi->deskripsi,
            'lokasi' => $request->lokasi,
            'id_kategoti_pekerjaan' => $request->id_kategoti_pekerjaan,
            'gaji' => $request->gaji,
            'tgl_upload' => now(),
            'id_dudi' => $request->iddudi,
        ]);
        return redirect('/company/lowongan-kerja/detail/'.$request->nama)->with('success', 'Lowongan telah ditambahkan!');
    }
    public function updateprofile(Request $request, DudiModel $alumniModel)
    {
        $validasiData = $request->validate([
            'nama' => 'max:225',
            'bidang' => 'max:225',
            'no_telp' => 'digits_between:1,15|numeric',
            'deskripsi' => '',
            'alamat' => '',
            'logo' => 'file|min:10|max:1024|image|mimes:jpeg,jpg',
        ]);
                
        $olddata = DudiModel::find($request->id);
        if ($image = $request->file('logo')) {
            $destinationPath = 'images/profileimg/';
            $logoimage = $request->id . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $logoimage);
            $validasiData['logo'] = "$logoimage";
            $imagename = $olddata->logo;
            $image1 = $imagename;
            File::delete(public_path("images/profileimg/$image1"));
        } else {
            $validasiData['logo'] = $olddata->logo;
        }
        
        $validasiData['user_id'] = auth()->user()->id;
        // dd($request->input('id'));
        if($request->password != null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo_profile' => $validasiData['logo']
        ]);
        }
        elseif($request->password == null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'photo_profile' => $validasiData['logo']
        ]);
        }
        DudiModel::where('id', $request->id)->update($validasiData);
        return redirect('/company/dashboard')->with('success', 'Data Profile Telah Berhasi Diubah!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}
