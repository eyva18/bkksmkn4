<?php

namespace app\Http\Controllers\ControllersAdmin;

use App\Models\AgamaModel;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\TahunLulusModel;
use App\Models\JenisKelaminModel;
use App\Http\Controllers\Controller;
use App\Models\JenisPendidikanModel;
use App\Models\RiwayatPendidikanModel;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AlumniModel $Alumni)
    {    
        if($request->idjurusan == null and $request->idtahunlulus == null and $request->nama_alumni == null){
            $dataalumni = AlumniModel::with('jurusan')->with('tahunlulus')->latest()->paginate(25);
        }  
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus != "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(25);
        }
        elseif($request->idjurusan != "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->latest()->paginate(25);
        }
        elseif($request->idtahunlulus != "Tahun Lulus" and $request->idjurusan == "Jurusan" ){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(25);
        }
        elseif($request->idjurusan == "Jurusan" and $request->idtahunlulus == "Tahun Lulus"){
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->latest()->paginate(25);
        }

        return view('admin.daftar.alumni.alumni', [
            'Alumni' => $Alumni,
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
        return view('admin.daftar.alumni.tambahalumni', [
            'dataAgama' => AgamaModel::all(),
            'dataJenisKelamin' => JenisKelaminModel::all(),
            'dataJurusan' => JurusanModel::all(),
            'dataTahunLulus' => TahunLulusModel::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'nisn' => 'required|digits_between:1,15|numeric|unique:alumni',
            'nis' => 'required|digits_between:1,15|numeric|unique:alumni',
            'nama' => 'required|max:225',
            'no_hp' => 'required|digits_between:1,15|numeric',
            'biografi' => 'required',
            'agamaId' => 'required|in:1,2,3,4,5',
            'jenis_kelaminId' => 'required|in:1,2',
            'alamat' => 'required',
            'tempatTanggalLahir' => 'required',
            'photo_profile' => 'required|file|min:10|max:1024|image|mimes:jpeg,jpg',
            'transkrip_nilai' => 'required|file|min:10|max:4096|mimes:doc,pdf,docx,jpg,jpeg',
            'kode_jurusanId' => 'required|in:1, 2, 3, 4, 5, 6, 7',
            'kode_lulusId' => 'required',
        ]);
        $validasiDataUser = $request->validate([
            'username' => 'required|max:225',
            'email' => 'required|max:225',
        ]);

        // $validasiData['biografi'] = strip_tags($request->biografi);
        // dd($validasiData);
        if($request->file('photo_profile')) {
            $validasiData['photo_profile'] = $request->file('photo_profile')->getClientOriginalName();
            $validasiData['photo_profile'] = $request->file('photo_profile')->storeAs('Photo_Profile_Alumni', $validasiData['photo_profile']);
        }

        if($request->file('transkrip_nilai')) {
            $validasiData['transkrip_nilai'] = $request->file('transkrip_nilai')->getClientOriginalName();
            $validasiData['transkrip_nilai'] = $request->file('transkrip_nilai')->storeAs('Transkrip_Nilai_Alumni', $validasiData['transkrip_nilai']);
        }

        $validasiData['user_id'] = auth()->user()->id;

        AlumniModel::create($validasiData);
        $useralumnicreate = User::create([
            'name' => $validasiDataUser['username'],
            'email' => $validasiDataUser['email'],
            'password' => bcrypt($validasiData['nisn']),
            'photo_profile' => $validasiData['photo_profile'] ?? null,
        ]);
        $useralumnicreate->assignRole('alumni');
        return redirect('/alumni')->with('success', 'Alumni telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AlumniModel $alumniModel)
    {
        $findSiswaProfile = $alumniModel->findOrFail($request->id);
        // dd($alumniModel);
        return view('admin.daftar.alumni.profilealumni', [
            'dataAlumni' => $findSiswaProfile,
            'dataJenisPendidikan' => JenisPendidikanModel::all(),
            'dataPendidikan' => RiwayatPendidikanModel::all(),
            'dataPekerjaan' => RiwayatPendidikanModel::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AlumniModel $alumniModel)
    {
        $dataAlumni = $alumniModel->find($request->id);
        return view('admin.daftar.alumni.ubahalumni', [
            "alumni" => $dataAlumni,
            'dataAgama' => AgamaModel::all(),
            'dataJenisKelamin' => JenisKelaminModel::all(),
            'dataJurusan' => JurusanModel::all(),
            'dataTahunLulus' => TahunLulusModel::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlumniModel $alumniModel)
    {
        $validasiData = $request->validate([
            'nisn' => 'digits_between:1,15|numeric',
            'nis' => 'digits_between:1,15|numeric',
            'nama' => 'max:225',
            'no_hp' => 'digits_between:1,15|numeric',
            'biografi' => '',
            'agamaId' => 'in:1,2,3,4,5',
            'jenis_kelaminId' => 'in:1,2',
            'alamat' => '',
            'tempatTanggalLahir' => '',
            'photo_profile' => 'file|min:10|max:1024|image|mimes:jpeg,jpg',
            'transkrip_nilai' => 'file|min:10|max:4096|mimes:doc,pdf,docx,jpg,jpeg',
            'kode_jurusanId' => 'in:1, 2, 3, 4, 5, 6, 7',      
            'kode_lulusId' => 'in:1,2,3',
        ]);
        
        // $validasiData['biografi'] = strip_tags($request->biografi);
        
        if($request->file('photo_profile')) {
            if($request->oldPhotoProfile) {
                Storage::delete($request->oldPhotoProfile);
            }
            $validasiData['photo_profile'] = $request->file('photo_profile')->getClientOriginalName();
            $validasiData['photo_profile'] = $request->file('photo_profile')->storeAs('Photo_Profile_Alumni', $validasiData['photo_profile']);
        }
        
        if($request->file('transkrip_nilai')) {
            if($request->oldTranskripNilai) {
                Storage::delete($request->oldTranskripNilai);
            }
            $validasiData['transkrip_nilai'] = $request->file('transkrip_nilai')->getClientOriginalName();
            $validasiData['transkrip_nilai'] = $request->file('transkrip_nilai')->storeAs('Transkrip_Nilai_Alumni', $validasiData['transkrip_nilai']);
        }
        
        $validasiData['user_id'] = auth()->user()->id;
        // dd($request->input('id'));
        
        AlumniModel::where('id', $request->id)->update($validasiData);
        $dataRequest = $alumniModel->findOrFail($request->id);
        return redirect('/alumni')->with('success', 'Data Alumni Telah Berhasi Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, AlumniModel $alumniModel)
    {
        $data = $alumniModel->findOrFail($request->id);

        if($data->photo_profile) {
            Storage::delete($data->photo_profile);
        }
        if($data->transkrip_nilai) {
            Storage::delete($data->transkrip_nilai);
        }

        AlumniModel::destroy($request->id);
        return redirect('/alumni');
    }
}
