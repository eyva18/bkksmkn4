<?php

namespace App\Http\Controllers;

use App\Imports\LaporanPerTahun;
use App\Imports\LaporanPickTahunan;
use App\Models\AlumniModel;
use App\Models\CategoryModel;
use App\Models\DudiModel;
use App\Models\JenisKelaminModel;
use App\Models\JurusanModel;
use App\Models\KepalaSekolahModel;
use App\Models\LowonganModel;
use App\Models\RiwayatPekerjaanModel;
use App\Models\RiwayatPendidikanModel;
use App\Models\SertifikasiLombaModel;
use App\Models\SertifikasiModel;
use App\Models\StatusAlumniModel;
use App\Models\TahunLulusModel;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class KepalaSekolahController extends Controller
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
            'bekerja' => StatusAlumniModel::where('status_bekerja', 1)->count(),
            'tidak_bekerja' => StatusAlumniModel::where('status_bekerja', 2)->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('status_pendidikan', 1)->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('status_pendidikan', 2)->count(),
        ];
        $DataLowonganKerja = [];
        $LabelLowonganDudi = [];
        foreach ($originaldudi as $original) {
            $yz = LowonganModel::where('id_dudi', $original->id)->count();
            if ($yz != 0) {
                $DataLowonganKerja[] = $yz;
                $LabelLowonganDudi[] = $original->nama;
            } else {
            }
        }
        $dataUser = KepalaSekolahModel::with('user')->where('user_id', Auth()->user()->id)->first();
        return view('kepalasekolah.dashboard', [
            'dataKepalaSekolah' => $dataUser,
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
    public function update_kutipan(Request $request)
    {
        KepalaSekolahModel::where('id', $request->id)->update([
            'kutipan' => $request->kutipan
        ]);
        return back()->with('success', 'Kutipan berhasil diubah');
    }
    public function daftaralumni()
    {
        $dataUser = KepalaSekolahModel::with('user')->where('user_id', Auth()->user()->id)->first();
        $Alumnidata = AlumniModel::paginate(9);
        $precentasekelengkapanprofile = [];
        $countdata = 0;
        foreach ($Alumnidata as $data) {
            $countdata = 0;
            $statusAlumnidata = StatusAlumniModel::where('nisn', $data->nisn)->first();
            $userAlumniData = User::find($data->user_id)->first();
            if ($data->nisn != null) {$countdata++;}
            if ($data->nis != null) {$countdata++;}
            if ($data->nama != null) {$countdata++;}
            if ($data->no_hp != null) {$countdata++;}
            if ($data->biografi != null) {$countdata++;}
            if ($data->agamaId != null) {$countdata++;}
            if ($data->jenis_kelaminId != null) {$countdata++;}
            if ($data->alamat != null) {$countdata++;}
            if ($data->tempatTanggalLahir != null) {$countdata++;}
            if ($data->photo_profile != null) {$countdata++;}
            if ($data->transkrip_nilai != null) {$countdata++;}
            if ($data->kode_jurusanId != null) {$countdata++;}
            if ($data->kode_lulusId != null) {$countdata++;}
            if ($statusAlumnidata->status_bekerja != null) {$countdata++;}
            if ($statusAlumnidata->status_pendidikan != null) {$countdata++;}
            if ($userAlumniData->name != null) {$countdata++;}
            if ($userAlumniData->email != null) {$countdata++;}
            if ($userAlumniData->password != null) {$countdata++;}
            $countprecentase = ($countdata/18)*100;
            $tostringpresentase = sprintf("%.0f", $countprecentase)."%";
            $precentasekelengkapanprofile[$data->nisn] = $tostringpresentase;
        }
        return view('kepalasekolah.daftaralumni.daftarAlumni', [
            'dataKepalaSekolah' => $dataUser,
            'Alumnidata' => $Alumnidata,
            'jurusan' => JurusanModel::all(),
            'tahunlulus' => TahunLulusModel::all(),
            "percentasaeprofile" => $precentasekelengkapanprofile,
        ]);
    }
    public function alumniprofile(AlumniModel $alumni)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();
        $dataPendidikan = RiwayatPendidikanModel::where('user_id', $alumni->user_id)->get();
        $dataPekerjaan = RiwayatPekerjaanModel::where('user_id', $alumni->user_id)->get();
        $dataSertifikasi = SertifikasiModel::where('user_id',  $alumni->user_id)->get();
        $dataSertifikasiLomba = SertifikasiLombaModel::where('user_id',  $alumni->user_id)->get();
        $dataStatusAlumni = StatusAlumniModel::where('user_id', $alumni->user_id)->get();
        foreach ($dataStatusAlumni as $data) {
            $dataStatusA = $data;
        }
        return view('kepalasekolah.daftaralumni.alumniprofiledetail', [
            'dataKepalaSekolah' => $dataUser,
            'dataAlumni' => $alumni,
            'dataStatusAlumni' => $dataStatusA,
            'dataPendidikan' => $dataPendidikan,
            'dataPekerjaan' => $dataPekerjaan,
            'dataSertifikasi' => $dataSertifikasi,
            'dataSertifikasiLomba' => $dataSertifikasiLomba,
            'alumnisekilas' => AlumniModel::where('id', '!=', $alumni->id)->paginate(3)
        ]);
    }
    public function alumnisearch(Request $request)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();
        if ($request->idjurusan == null and $request->idtahunlulus == null and $request->nama_alumni == null) {
            $dataalumni = AlumniModel::with('jurusan')->with('tahunlulus')->latest()->paginate(9);
        } elseif ($request->idjurusan != "Jurusan" and $request->idtahunlulus != "Tahun Lulus") {
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(9);
        } elseif ($request->idjurusan != "Jurusan" and $request->idtahunlulus == "Tahun Lulus") {
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_jurusanId', $request->idjurusan)->latest()->paginate(9);
        } elseif ($request->idtahunlulus != "Tahun Lulus" and $request->idjurusan == "Jurusan") {
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->where('kode_lulusId', $request->idtahunlulus)->latest()->paginate(9);
        } elseif ($request->idjurusan == "Jurusan" and $request->idtahunlulus == "Tahun Lulus") {
            $dataalumni = AlumniModel::where('nama', 'like', "%" . $request->nama_alumni . "%")->latest()->paginate(9);
        }
        return view('kepalasekolah.daftaralumni.daftarAlumni', [
            'dataKepalaSekolah' => $dataUser,
            "Alumnidata" => $dataalumni,
            "jurusan" => JurusanModel::all(),
            "tahunlulus" => TahunLulusModel::all()
        ]);
    }
    public function daftarPerusahaan()
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();
        $lowongandata = LowonganModel::paginate(3);
        $dudidata = DudiModel::paginate(10);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($dudidata as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        return view('kepalasekolah.daftarlperusahaan.daftarperusahaan', [
            "lowongan" => $lowongandata,
            "perusahaan" => $dudidata,
            "countlowongan" => $lowongan,
            'dataKepalaSekolah' => $dataUser,
        ]);
    }
    public function profileperusahaan(DudiModel $dudi)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $dataperusahaan = DudiModel::with('userdata')->find($dudi->id);
            return view('kepalasekolah.daftarlperusahaan.profileperusahaan', [
                'dataperusahaan' => $dataperusahaan,
                'lowongan' => LowonganModel::where('id_dudi', $dudi->id)->with('kategori')->paginate(4),
                'dataKepalaSekolah' => $dataUser,
            ]);
    }
    public function perusahaansearch(Request $request)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $lowongandata = LowonganModel::paginate(3);
        $dudidata = DudiModel::where('nama', 'like', "%" . $request->nama_perusahaan . "%")->paginate(10);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($dudidata as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
            return view('kepalasekolah.daftarlperusahaan.daftarperusahaan', [
                "lowongan" => $lowongandata,
                "perusahaan" => $dudidata,
                "countlowongan" => $lowongan,
                'dataKepalaSekolah' => $dataUser,

            ]);
    }
    public function daftarLowongan()
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $datadudi = DudiModel::paginate(3);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
            return view('kepalasekolah.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataKepalaSekolah' => $dataUser,

            ]);
    }
    public function daftarLowongansearch(Request $request)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $datadudi = DudiModel::paginate(3);
        //Count Lowongan Kerja
        $lowongan = [];
        foreach ($datadudi as $data) {
            $yz = LowonganModel::where('id_dudi', $data->id)->count();
            $lowongan[$data->id] = $yz;
        }
        if ($request->nama_lowongan == null and $request->category == "Spesialis Pekerjaan") {
            return view('kepalasekolah.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::with('dudi')->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataKepalaSekolah' => $dataUser,


            ]);
        } elseif ($request->nama_lowongan != null and $request->category == "Spesialis Pekerjaan") {
            return view('kepalasekolah.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataKepalaSekolah' => $dataUser,


            ]);
        } elseif ($request->nama_lowongan != null and $request->category != "Spesialis Pekerjaan") {
            return view('kepalasekolah.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('nama', 'like', "%" . $request->nama_lowongan . "%")->where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataKepalaSekolah' => $dataUser,


            ]);
        } elseif ($request->nama_lowongan == null and $request->category != "Spesialis Pekerjaan") {
            return view('kepalasekolah.daftarlowongan.daftarLowongan', [
                'lowongan' => LowonganModel::where('id_kategoti_pekerjaan', $request->category)->paginate(10),
                "datadudi" => $datadudi,
                "countlowongan" => $lowongan,
                'category' => CategoryModel::all(),
                'dataKepalaSekolah' => $dataUser,


            ]);
        }
    }
    public function detaillowongan(LowonganModel $lowongan)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $datalowongan = LowonganModel::with('dudi')->with('kategori')->find($lowongan->id);
            return view('kepalasekolah.daftarlowongan.detaillowongan', [
                'datalowongan' => $datalowongan,
                'lowongansekilas' => LowonganModel::with('dudi')->with('kategori')->where('id', '!=', $lowongan->id)->paginate(3),
                'dataKepalaSekolah' => $dataUser,
            ]);
    }
    public function laporankelulusan()
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('status_bekerja', 1)->count(),
            'tidak_bekerja' => StatusAlumniModel::where('status_bekerja', 2)->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('status_pendidikan', 1)->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('status_pendidikan', 2)->count(),
        ];
        $originaljurusan = JurusanModel::orderBy("created_at")->get();
        $DataJurusan = [];
        $LabelJurusan = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_jurusanId', $original->id)->count();
            $DataJurusan[] = $yz;
            $LabelJurusan[] = $original->jurusan;
        }
        //Jurusan Database Function
        $datajurusanOriginal = JurusanModel::all();
        //Data Foward Function
        $datajurusanalumni = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = AlumniModel::where('kode_jurusanId', $original->id)->count();
            $datajurusanalumni[$original->id] = $yz;
        }
        $dataalumnikuliah = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('jurusan', $original->id)->where('status_pendidikan', 1)->count();
            $dataalumnikuliah[$original->id] = $yz;
        }
        $dataalumnibekerja = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('jurusan', $original->id)->where('status_bekerja', 1)->count();
            $dataalumnibekerja[$original->id] = $yz;
        }
        return view('kepalasekolah.laporan.lapotantahun', [
            'totalAlumni' => AlumniModel::count(),
            'totalperusahaan' => DudiModel::count(),
            'totallowongan' => LowonganModel::count(),
            'DataChartStatus' => ($DataChartStatus),
            'DataJurusan' => ($DataJurusan),
            'LabelJurusan' => ($LabelJurusan),
            'orginDataJurusan' => $datajurusanOriginal,
            'datajurusanalumni' => $datajurusanalumni,
            'dataalumnikuliah' => $dataalumnikuliah,
            'dataalumnibekerja' => $dataalumnibekerja,
            'tahunlulus'=> TahunLulusModel::all(),
            'dataKepalaSekolah' => $dataUser,
            'tahunlulusdata' => null

        ]);
    }

    public function laporan_yearly(Request $request)
    {
        if($request->idtahunlulus == null){
            return redirect('/kepala-sekolah/report/yearly');
        }
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('status_bekerja', 1)->count(),
            'tidak_bekerja' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('status_bekerja', 2)->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('status_pendidikan', 1)->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('status_pendidikan', 2)->count(),
        ];
        $originaljurusan = JurusanModel::orderBy("created_at")->get();
        $DataJurusan = [];
        $LabelJurusan = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_lulusId', $request->idtahunlulus)->where('kode_jurusanId', $original->id)->count();
            $DataJurusan[] = $yz;
            $LabelJurusan[] = $original->jurusan;
        }
        //Jurusan Database Function
        $datajurusanOriginal = JurusanModel::all();
        //Data Foward Function
        $datajurusanalumni = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = AlumniModel::where('kode_lulusId', $request->idtahunlulus)->where('kode_jurusanId', $original->id)->count();
            $datajurusanalumni[$original->id] = $yz;
        }
        $dataalumnikuliah = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('jurusan', $original->id)->where('status_pendidikan', 1)->count();
            $dataalumnikuliah[$original->id] = $yz;
        }
        $dataalumnibekerja = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('jurusan', $original->id)->where('status_bekerja', 1)->count();
            $dataalumnibekerja[$original->id] = $yz;
        }
        return view('kepalasekolah.laporan.lapotantahun', [
            'dataKepalaSekolah' => $dataUser,
            'totalAlumni' => AlumniModel::count(),
            'totalperusahaan' => DudiModel::count(),
            'totallowongan' => LowonganModel::count(),
            'DataChartStatus' => ($DataChartStatus),
            'DataJurusan' => ($DataJurusan),
            'LabelJurusan' => ($LabelJurusan),
            'orginDataJurusan' => $datajurusanOriginal,
            'datajurusanalumni' => $datajurusanalumni,
            'dataalumnikuliah' => $dataalumnikuliah,
            'dataalumnibekerja' => $dataalumnibekerja,
            'tahunlulus'=> TahunLulusModel::all(),
            'tahunlulusdata' => TahunLulusModel::find($request->idtahunlulus)

        ]);
    }
    public function detail_laporan_perjurusan($idjurusan)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();

        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('jurusan', $idjurusan)->where('status_bekerja', 1)->count(),
            'tidak_bekerja' => StatusAlumniModel::where('jurusan', $idjurusan)->where('status_bekerja', 2)->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('jurusan', $idjurusan)->where('status_pendidikan', 1)->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('jurusan', $idjurusan)->where('status_pendidikan', 2)->count(),
        ];
        $originalalumnidata = AlumniModel::where('kode_jurusanId', $idjurusan)->paginate(10);
        $statusalumni = [];
        foreach ($originalalumnidata as $original) {
            $status = StatusAlumniModel::where('nisn', $original->nisn)->first();
            $statusalumni[$original->id] = $status;
        }
        return view('kepalasekolah.laporan.detaillaporan', [
            'DataChartStatus' => ($DataChartStatus),
            'jurusandata' => JurusanModel::find($idjurusan),
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,
            'dataKepalaSekolah' => $dataUser,

        ]);
    }
    public function detail_laporan_perjurusan_pertahun(TahunLulusModel $tahun_lulus, $idjurusan)
    {
        $dataUser = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();
        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('jurusan', $idjurusan)->where('tahun_lulus', $tahun_lulus->id)->where('status_bekerja', 1)->count(),
            'tidak_bekerja' => StatusAlumniModel::where('jurusan', $idjurusan)->where('tahun_lulus', $tahun_lulus->id)->where('status_bekerja', 2)->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('jurusan', $idjurusan)->where('tahun_lulus', $tahun_lulus->id)->where('status_pendidikan', 1)->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('jurusan', $idjurusan)->where('tahun_lulus', $tahun_lulus->id)->where('status_pendidikan', 2)->count(),
        ];
        $originalalumnidata = AlumniModel::where('kode_jurusanId', $idjurusan)->where('kode_lulusId', $tahun_lulus->id)->paginate(10);
        $statusalumni = [];
        foreach ($originalalumnidata as $original) {
            $status = StatusAlumniModel::where('nisn', $original->nisn)->first();
            $statusalumni[$original->id] = $status;
        }
        return view('kepalasekolah.laporan.detailperlaporan', [
            'DataChartStatus' => ($DataChartStatus),
            'jurusandata' => JurusanModel::find($idjurusan),
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,
            'tahunlulusdata' => TahunLulusModel::where('tahun_lulus', $tahun_lulus->tahun_lulus)->first(),
            'dataKepalaSekolah' => $dataUser,
        ]);
    }
    public function detail_laporan_perjurusan_export($idjurusan)
    {
        $jurusanget = JurusanModel::find($idjurusan);
        $namepathfile = 'Laporan-Jurusan#'.$jurusanget->jurusan.' - Semua-Tahun'.'.xlsx';
        return Excel::download(new LaporanPerTahun($idjurusan), $namepathfile);
        return back();
    }
    
    public function detail_laporan_perjurusan_pertahun_export(TahunLulusModel $tahun_lulus ,$idjurusan)
    {
        $jurusanget = JurusanModel::find($idjurusan);
        $namepathfile = 'Laporan-Jurusan#'.$jurusanget->jurusan.' - Tahun#'.$tahun_lulus->tahun_lulus.'.xlsx';
        return Excel::download(new LaporanPickTahunan($tahun_lulus->id, $idjurusan), $namepathfile);
        return back();
    }
    public function kepalasekolahprofile(User $userdata)
    {
        $dataKepalaSekolah = KepalaSekolahModel::where('user_id', Auth()->user()->id)->first();
        return view('kepalasekolah.profile', [
            'dataKepalaSekolah' => $dataKepalaSekolah,
            'dataUser' => User::find(Auth()->user()->id),
            'dataJenisKelamin' => JenisKelaminModel::all()
        ]);        
    }
    public function updateprofile(Request $request, KepalaSekolahModel $kepala_sekolah)
    {
        $validasiDataPhoto = [
            'photo_profile' => 'file|min:10|max:1024|image|mimes:jpeg,jpg',
        ];
        $validasiData = $request->validate([
            'nama' => 'max:225',
            'tahun_jabatan' => 'max:225',
            'no_telp' => 'digits_between:1,15|numeric',
            'kutipan' => '',
            'jenis_kelamin' => '',
        ]);
                
        $olddatakepalasekolah = KepalaSekolahModel::find($request->id);
        $olddata = User::find($olddatakepalasekolah->user_id);
        if ($image = $request->file('photo_profile')) {
            $destinationPath = 'images/profileimg/';
            $logoimage = $request->id . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $logoimage);
            $validasiDataPhoto['photo_profile'] = "$logoimage";
            $imagename = $olddata->logo;
            $image1 = $imagename;
            File::delete(public_path("images/profileimg/$image1"));
        } else {
            $validasiDataPhoto['photo_profile'] = $olddata->photo_profile;
        }
        
        $validasiData['user_id'] = auth()->user()->id;
        // dd($request->input('id'));
        if($request->password != null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo_profile' => $validasiDataPhoto['photo_profile']
        ]);
        }
        elseif($request->password == null){
            User::where('id', $olddata->user_id)->update([
                'name' => $request->username,
                'email' => $request->email,
                'photo_profile' => $validasiDataPhoto['photo_profile']
        ]);
        }
        KepalaSekolahModel::where('id', $request->id)->update($validasiData);
        return redirect('/kepala-sekolah/dashboard')->with('success', 'Data Profile Telah Berhasi Diubah!');
    }
}
