<?php

namespace app\Http\Controllers\ControllersAdmin;;

use Carbon\Carbon;
use App\Models\User;
use App\Models\DudiModel;
use App\Models\AgamaModel;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\LowonganModel;
use App\Models\TahunLulusModel;
use App\Models\JenisKelaminModel;
use App\Models\StatusAlumniModel;
use App\Models\JenisPekerjaanModel;
use App\Http\Controllers\Controller;
use App\Models\JenisPendidikanModel;
use Illuminate\Support\Facades\File;
use App\Models\RiwayatPekerjaanModel;
use App\Models\RiwayatPendidikanModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $originaltahunlulusan = TahunLulusModel::orderBy("created_at")->get();
        $originaljurusan = JurusanModel::orderBy("created_at")->get();
        $originaldudi = DudiModel::orderBy("created_at")->get();
        //Data Foward Function
        $datatahunlulusanalumni = [];
        $chartTahunLulusAlumni = [];
        $tahunLulusChart = [];
        foreach ($originaltahunlulusan as $original) {
            $yz = AlumniModel::where('kode_lulusId', $original->id)->count();
            $datatahunlulusanalumni[$original->tahun_lulus] = $yz;
            $chartTahunLulusAlumni[] = $yz;
            $tahunLulusChart[] = $original->tahun_lulus;
        }
        //Data Foward Function
        $DataChartJurusan = [];
        $LabelsChartJurusan = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_jurusanId', $original->id)->count();
            $DataChartJurusan[] = $yz;
            $LabelsChartJurusan[] = $original->jurusan;
        }
        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('bekerja', 'bekerja')->count(),
            'tidak_bekerja' => StatusAlumniModel::where('bekerja', 'tidak bekerja')->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('pendidikan', 'melanjutkan pendidikan')->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('pendidikan', 'tidak melanjutkan pendidikan')->count(),
        ];
        $DataLowonganKerja = [];
        $LabelLowonganDudi = [];
        foreach ($originaldudi as $original) {
            $yz = LowonganModel::where('id_dudi', $original->id)->count();
            if($yz != 0){
            $DataLowonganKerja[] = $yz;
            $LabelLowonganDudi[] = $original->nama;
            }
            else{

            }
        }
        return view('admin.dashboard.dashboard', [
            'totalAlumni' => AlumniModel::count(),
            'totalperusahaan' => DudiModel::count(),
            'totallowongan' => LowonganModel::count(),
            "datatahunlulusanalumni" => $datatahunlulusanalumni,
            "datatahunlulusan" => $originaltahunlulusan,
            'LabelCharttahunlulus' => ($tahunLulusChart),
            'DataCharttahunlulus' => ($chartTahunLulusAlumni),
            'LabelsChartJurusan' => ($LabelsChartJurusan),
            'DataChartJurusan' => ($DataChartJurusan),
            'DataChartStatus' => ($DataChartStatus),
            'LabelLowonganDudi' => ($LabelLowonganDudi),
            'DataLowonganKerja' => ($DataLowonganKerja),
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
            $yz = AlumniModel::where('kode_jurusanId', $original->id)->count();
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
            $yz = AlumniModel::where('kode_lulusId', $original->id)->count();
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
        $datadudi = DudiModel::latest()->paginate(10);
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
        $olddata = DudiModel::find($request->id);
        if ($image = $request->file('logo')) {
            $destinationPath = 'images/profileimg/';
            $logoimage = $request->id . "%" . $image->getClientOriginalName();
            $image->move($destinationPath, $logoimage);
            $logo = "$logoimage";
            $imagename = $olddata->logo;
            $image1 = $imagename;
            File::delete(public_path("images/profileimg/$image1"));
        } else {
            $logo = $olddata->logo;
        }
         DudiModel::find($request->id)->update([
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'no_telp' => $request->no_telp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'logo' => $logo,
        ]);
        $pw = null;
        if($request->password != null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo_profile' => $logo
        ]);
        }
        elseif($request->password == null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'photo_profile' => $logo
        ]);
        }
        $dudiafterupdate = DudiModel::find($request->id);
        return redirect('/admin/administrator/master/company/profile/'.$dudiafterupdate->nama);
    }
    public function dudi_add(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
         ]);
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
        $userdudi = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo_profile' => $logo
        ]);
        $userdudi->assignRole('dudi');
        $dudidata = DudiModel::create([
            'id' => $fixidcreate,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'no_telp' => $request->no_telp,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'logo' => $logo,
            'user_id' => $userdudi->id,
        ]);
        return redirect('/admin/administrator/master/company/profile/'.$dudidata->nama);
    }
    public function dudi_delete(Request $request)
    {
        $data = DudiModel::find($request->id);
        $imagename = $data->logo;
        $image1 = $imagename;
        File::delete(public_path("images/profileimg/$image1"));
        User::find($data->user_id)->delete();
        DudiModel::find($request->id)->delete();
        return back();
    }
    public function dudi_search(Request $request)
    {
        //Jurusan Database Function
        $datadudi = DudiModel::where('nama', 'like', "%" . $request->nama_perusahaan . "%")->paginate(10);
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
    public function dudi_profile(DudiModel $dudi)
    {
        //Jurusan Database Function
        $datadudi = $dudi;
        $userdudi = User::where('id', $dudi->user_id)->first();
        //Count Lowongan Kerja
        $lowongan = LowonganModel::where('id_dudi', $dudi->id)->with('dudi')->with('kategori')->paginate(10);
        return view('admin.daftar.dudi.profiledudi', [
            "datadudi" => $datadudi,
            "lowongan" => $lowongan,
            "userdudi" => $userdudi
        ]);
    }
    public function editdudi_profile(DudiModel $dudi)
    {
        //Jurusan Database Function
        $datadudi = $dudi;
        $akundudi = User::where('id', $dudi->user_id)->first();
        //Count Lowongan Kerja
        return view('admin.daftar.dudi.ubahdudi', [
            "datadudi" => $datadudi,
            "dudiakun" => $akundudi,
            'bidangdata' => CategoryModel::all()
        ]);
    }

    //Alumni Function Here ------------------------------
    public function alumni_index(Request $request, AlumniModel $Alumni)
    {
        //Jurusan Database Function
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

    public function alumni_create() {
        return view('admin.daftar.alumni.tambahalumni', [
            'dataAgama' => AgamaModel::all(),
            'dataJenisKelamin' => JenisKelaminModel::all(),
            'dataJurusan' => JurusanModel::all(),
            'dataTahunLulus' => TahunLulusModel::all(),
        ]);
    }

    public function alumni_store(Request $request) {
        $validasiData = $request->validate([
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required|max:225',
            'no_hp' => '',
            'biografi' => '',
            'agamaId' => '',
            'jenis_kelaminId' => '',
            'alamat' => '',
            'tempatTanggalLahir' => '',
            'photo_profile' => '',
            'transkrip_nilai' => '',
            'kode_jurusanId' => '',
            'kode_lulusId' => '',
        ]);
        $validasiDataUser = $request->validate([
            'username' => 'required|max:225',
            'email' => '',
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
        
        $useralumnicreate = User::create([
            'name' => $validasiDataUser['username'],
            'email' => $validasiDataUser['email'],
            'password' => bcrypt($validasiData['nisn']),
            'photo_profile' => $validasiData['photo_profile'] ?? null,
        ])->assignRole('alumni');

        $validasiData['user_id'] = $useralumnicreate->id;

        AlumniModel::create($validasiData);
        return redirect('/alumni')->with('success', 'Alumni telah ditambahkan!');
    }

    public function riwayatpendidikan_store(Request $request) {
        $dataAlumni = AlumniModel::findOrFail($request->id);
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_instansi' => 'string',
            'jenis_pendidikan' => 'in:1, 2, 3, 4, 5',
            'nilai_rata_rata' => 'numeric|decimal:0,100.00',
            'tahun_awal_pendidikan' => 'date',
            'tahun_akhir_pendidikan' => 'date',
        ]);

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
            'tahun_akhir_pekerjaan' => 'date',
        ]);


        $tanggalAwal = $validasiData['tahun_awal_pekerjaan'];
        $validasiData['tahun_awal_pekerjaan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pekerjaan'])->format('l, j F Y');
        
        $tanggalAkhir = $validasiData['tahun_akhir_pekerjaan'];
        $validasiData['tahun_akhir_pekerjaan'] = date('d/m/Y', strtotime($tanggalAkhir));
        $validasiData['tahun_akhir_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pekerjaan'])->format('l, j F Y');

        $findUser = User::findOrFail($dataAlumni->user_id);
        $validasiData['user_id'] = $findUser->id;
        dd($validasiData);
        // dd($validasiData);
        RiwayatPekerjaanModel::create($validasiData);
        return back()->with('success', 'Riwayat pekerjaan berhasil ditambahkan');
    }

    public function alumni_show(Request $request, AlumniModel $alumniModel) {
        $findSiswaProfile = $alumniModel->findOrFail($request->id);
        $dataUser = User::findOrFail($findSiswaProfile->user_id);
        // dd($alumniModel);
        return view('admin.daftar.alumni.profilealumni', [
            'dataAlumni' => $findSiswaProfile,
            'dataUser' => $dataUser,
            'dataJenisPendidikan' => JenisPendidikanModel::all(),
            'dataJenisPekerjaan' => JenisPekerjaanModel::all(),
            'dataPendidikan' => RiwayatPendidikanModel::where('user_id', $findSiswaProfile->user_id)->latest()->get(),
            'dataPekerjaan' => RiwayatPekerjaanModel::where('user_id', $findSiswaProfile->user_id)->latest()->get(),
        ]);
    }

    public function alumni_edit(Request $request, AlumniModel $alumniModel) {
        $dataAlumni = $alumniModel->findOrFail($request->id);
        $dataUser = User::findOrFail($dataAlumni->user_id);
        return view('admin.daftar.alumni.ubahalumni', [
            "alumni" => $dataAlumni,
            "dataUser" => $dataUser,
            'dataAgama' => AgamaModel::all(),
            'dataJenisKelamin' => JenisKelaminModel::all(),
            'dataJurusan' => JurusanModel::all(),
            'dataTahunLulus' => TahunLulusModel::all()
        ]);
    }

    public function alumni_update(Request $request) {
        $alumnidata = AlumniModel::find($request->id);

        $validasiData = $request->validate([
            'nisn' => 'required|unique:alumni',
            'nis' => 'required|unique:alumni',
            'nama' => 'required|max:225',
            'no_hp' => 'required',
            'biografi' => '',
            'agamaId' => 'required',
            'jenis_kelaminId' => 'required',
            'alamat' => 'required',
            'tempatTanggalLahir' => 'required',
            'photo_profile' => '',
            'transkrip_nilai' => '',
            'kode_jurusanId' => 'required',      
            'kode_lulusId' => 'required',
        ]);
        $validasiDataUser = $request->validate([
            'username' => 'required|max:225',
            'email' => 'required|unique:users',
            'password' => ''
        ]);
        // $validasiData['biografi'] = strip_tags($request->biografi);
        $validasiData['photo_profile'] = $request->oldPhotoProfile;
        
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

        $useralumnidata = User::find($alumnidata->user_id);
        $validasiData['user_id'] = $useralumnidata->id;
        AlumniModel::where('id', $request->id)->update($validasiData);
        if($request->password != null){
            User::findOrFail($validasiData['user_id'])->update([
                'name' => $validasiDataUser['username'],
                'email' => $validasiDataUser['email'],
                'password' => bcrypt($validasiDataUser['password']),
                'photo_profile' => $validasiData['photo_profile'],
            ]);
        } elseif($request->password == null){
            User::findOrFail($validasiData['user_id'])->update([
                'name' => $validasiDataUser['username'],
                'email' => $validasiDataUser['email'],
                'photo_profile' => $validasiData['photo_profile'],
            ]);
        }
        if (Auth::user()->hasRole('admin')) {
            return redirect('/alumni')->with('success', 'Data Alumni Telah Berhasi Diubah!');
        } 
        if (Auth::user()->hasRole('alumni')) {
            return redirect('/dashboard')->with('success', 'Data Alumni Telah Berhasi Diubah!');
        }
        // tampilkan ke funtion show 
    }

    public function update_biografi(Request $request) {
        $validasiDataBiografi = $request->validate([
            'biografi' => '',
        ]);
        // $validasiData['biografi'] = strip_tags($request->biografi);
        // dd($validasiDataBiografi['biografi']);

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
            'tahun_akhir_pendidikan' => 'date',
        ]);
        $tanggalAwal = $validasiData['tahun_awal_pendidikan'];
        $validasiData['tahun_awal_pendidikan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pendidikan'])->format('l, j F Y');
        
        $tanggalAkhir = $validasiData['tahun_akhir_pendidikan'];
        $validasiData['tahun_akhir_pendidikan'] = date('d/m/Y', strtotime($tanggalAkhir));
        $validasiData['tahun_akhir_pendidikan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pendidikan'])->format('l, j F Y');

        RiwayatPendidikanModel::findOrFail($request->id)->update($validasiData);
        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan');
    }

    public function riwayatpekerjaan_update(Request $request) {
        $validasiData = $request->validate([
            'nisn' => 'numeric',
            'nama_perusahaan' => 'string',
            'jenis_pekerjaan' => 'in:1, 2, 3, 4, 5',
            'bidang' => 'string',
            'tahun_awal_pekerjaan' => 'date',
            'tahun_akhir_pekerjaan' => 'date',
        ]);
        $tanggalAwal = $validasiData['tahun_awal_pekerjaan'];
        $validasiData['tahun_awal_pekerjaan'] = date('d/m/Y', strtotime($tanggalAwal));
        $validasiData['tahun_awal_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_awal_pekerjaan'])->format('l, j F Y');
        
        $tanggalAkhir = $validasiData['tahun_akhir_pekerjaan'];
        $validasiData['tahun_akhir_pekerjaan'] = date('d/m/Y', strtotime($tanggalAkhir));
        $validasiData['tahun_akhir_pekerjaan'] = Carbon::createFromFormat('d/m/Y', $validasiData['tahun_akhir_pekerjaan'])->format('l, j F Y');
        
        // dd($validasiData);
        RiwayatPekerjaanModel::findOrFail($request->id)->update($validasiData);
        return back()->with('success', 'Riwayat pekerjaan berhasil ditambahkan');
    }

    public function alumni_destroy(Request $request, AlumniModel $alumniModel) 
    {
        $data = $alumniModel->findOrFail($request->id);
        $dataUser = User::find($data->user_id);
        if($data->photo_profile) {
            Storage::delete($data->photo_profile);
        }
        if($data->transkrip_nilai) {
            Storage::delete($data->transkrip_nilai);
        }

        AlumniModel::destroy($request->id);
        User::destroy($dataUser->id);
        return back();
    }

    public function riwayatpendidikan_destroy(Request $request) {
        RiwayatPendidikanModel::destroy($request->id);
        return back()->with('success', 'Data Riwayat Pendidikan Berhasil Dihapus');
    }

    public function riwayatpekerjaan_destroy(Request $request) {
        RiwayatPekerjaanModel::destroy($request->id);
        return back()->with('success', 'Data Riwayat Pekerjaan Berhasil Dihapus');
    }
}
