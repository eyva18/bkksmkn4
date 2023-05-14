<?php

namespace app\Http\Controllers\ControllersAdmin;;

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
use App\Http\Controllers\Controller;
use App\Models\JenisPendidikanModel;
use Illuminate\Support\Facades\File;
use App\Models\RiwayatPekerjaanModel;
use App\Models\RiwayatPendidikanModel;
use Illuminate\Support\Facades\Storage;

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
        $datadudi = DudiModel::paginate(10);
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
            User::where('kode_owner', $request->id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo_profile' => $logo
        ]);
        }
        elseif($request->password == null){
            User::where('kode_owner', $request->id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'photo_profile' => $logo
        ]);
        }
        return redirect()->route('admin@master_company');
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
        $userdudi = User::where('kode_owner', $dudi->id)->first();
        //Count Lowongan Kerja
        $lowongan = LowonganModel::where('id_dudi', $dudi->id)->with('dudi')->with('kategori')->get();
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
        $akundudi = User::where('kode_owner', $dudi->id)->first();
        //Count Lowongan Kerja
        return view('admin.daftar.dudi.ubahdudi', [
            "datadudi" => $datadudi,
            "dudiakun" => $akundudi,
            'bidangdata' => CategoryModel::all()
        ]);
    }

    //Alumni Function Here ------------------------------
    public function alumni_index()
    {
        //Jurusan Database Function
        $dataalumni = AlumniModel::with('jurusan')->with('tahunlulus')->paginate(10);
        return view('admin.daftar.alumni.alumni', [
            "dataalumni" => $dataalumni,
            "datajurusan" => JurusanModel::all(),
            "datatahunlulus" => TahunLulusModel::all()
        ]);
    }
    
    public function alumni_search(Request $request, AlumniModel $Alumni)
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
            'kode_lulusId' => 'required|in:1,2,3',
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
        return redirect('/alumni')->with('success', 'Alumni telah ditambahkan!');
    }

    public function storeAlumniAccount(Request $request) {

        // $request['username'] = AlumniModel
        $validasiData = $request->validate([
            'username' => '',
            'email' => '',
            'password' => ''
        ]);

    }

    public function storeRiwayatPendidikan(Request $request) {
        $validasiDataRiwayatPendidikan = $request->validate([
            'nama_instansi' => '',
            'jenis_pendidikan' => 'required|in:1, 2, 3, 4, 5',
            'nilai_rata_rata' => 'numeric|decimal:0,100.00',
        ]);

        // $dataRiwayat = RiwayatAlumniModel::find($request->id);
        RiwayatPendidikanModel::create($validasiDataRiwayatPendidikan);
        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan');
    }

    public function storeRiwayatPekerjaan(Request $request) {

        $validasiRiwayatPekerjaan = $request->validate([
            'nama_perusahaan' => '',
            'jenis_pekerjaan' => '',
            'bidang' => '',
            'awal_bekerja' => '',
            'akhir_bekerja' => '',
        ]);

        // $dataRiwayat = RiwayatAlumniModel::find($request->id);
        RiwayatPekerjaanModel::create($validasiRiwayatPekerjaan);
        return back()->with('success', 'Riwayat pekerjaan berhasil ditambahkan');
    }

    public function alumni_show(Request $request, AlumniModel $alumniModel) {
        $findSiswaProfile = $alumniModel->findOrFail($request->id);
        // dd($alumniModel);
        return view('admin.daftar.alumni.profilealumni', [
            'dataAlumni' => $findSiswaProfile,
            'dataJenisPendidikan' => JenisPendidikanModel::all(),
            'dataPendidikan' => RiwayatPendidikanModel::all(),
            'dataPekerjaan' => RiwayatPendidikanModel::all(),
        ]);
    }

    public function alumni_edit(Request $request, AlumniModel $alumniModel) {
        $dataAlumni = $alumniModel->find($request->id);
        return view('admin.daftar.alumni.ubahalumni', [
            "alumni" => $dataAlumni,
            'dataAgama' => AgamaModel::all(),
            'dataJenisKelamin' => JenisKelaminModel::all(),
            'dataJurusan' => JurusanModel::all(),
            'dataTahunLulus' => TahunLulusModel::all()
        ]);
    }

    public function alumni_update(Request $request, AlumniModel $alumniModel) {
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
        // return redirect('')->with('success', 'Data Alumni Telah Berhasi Diubah!'); // tampilkan ke funtion show 
    }

    public function update_biografi(Request $request) {
        $validasiDataBiografi = $request->validate([
            'biografi' => '',
        ]);
        // $validasiData['biografi'] = strip_tags($request->biografi);
        // dd($validasiData['biografi']);

        $dataBio = AlumniModel::find($request->id);
        AlumniModel::where('id', $dataBio->id)->update($validasiDataBiografi);
        return back()->with('success', 'Biografi berhasil diubah');
    }

    public function alumni_destroy(Request $request, AlumniModel $alumniModel) 
    {
        $data = $alumniModel->findOrFail($request->id);
        if($data->photo_profile) {
            Storage::delete($data->photo_profile);
        }
        if($data->transkrip_nilai) {
            Storage::delete($data->transkrip_nilai);
        }

        AlumniModel::destroy($request->id);
        return back();
    }
}
