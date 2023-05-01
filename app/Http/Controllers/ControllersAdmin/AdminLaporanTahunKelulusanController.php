<?php

namespace app\Http\Controllers\ControllersAdmin;

use App\Models\DudiModel;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\LowonganModel;
use App\Models\TahunLulusModel;
use App\Models\StatusAlumniModel;
use App\Http\Controllers\Controller;

class AdminLaporanTahunKelulusanController extends Controller
{
    public function index()
    {
        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('bekerja', 'bekerja')->count(),
            'tidak_bekerja' => StatusAlumniModel::where('bekerja', 'tidak bekerja')->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('pendidikan', 'melanjutkan pendidikan')->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('pendidikan', 'tidak melanjutkan pendidikan')->count(),
        ];
        $originaljurusan = JurusanModel::orderBy("created_at")->get();
        $DataJurusan = [];
        $LabelJurusan = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_jurusan', $original->id)->count();
            $DataJurusan[] = $yz;
            $LabelJurusan[] = $original->jurusan;
        }
        //Jurusan Database Function
        $datajurusanOriginal = JurusanModel::all();
        //Data Foward Function
        $datajurusanalumni = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = AlumniModel::where('kode_jurusan', $original->id)->count();
            $datajurusanalumni[$original->id] = $yz;
        }
        $dataalumnikuliah = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('id_jurusan', $original->id)->where('pendidikan', 'melanjutkan pendidikan')->count();
            $dataalumnikuliah[$original->id] = $yz;
        }
        $dataalumnibekerja = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('id_jurusan', $original->id)->where('bekerja', 'bekerja')->count();
            $dataalumnibekerja[$original->id] = $yz;
        }
        return view('admin.laporan.laporantahun', [
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
            'tahunlulus'=> TahunLulusModel::all()

        ]);
    }
    public function laporan_yearly(Request $request)
    {
        $DataChartStatus = [
            'bekerja' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('bekerja', 'bekerja')->count(),
            'tidak_bekerja' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('bekerja', 'tidak bekerja')->count(),
            'malanjutkan_pendidikan' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('pendidikan', 'melanjutkan pendidikan')->count(),
            'tidakmalanjutkan_pendidikan' => StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('pendidikan', 'tidak melanjutkan pendidikan')->count(),
        ];
        $originaljurusan = JurusanModel::orderBy("created_at")->get();
        $DataJurusan = [];
        $LabelJurusan = [];
        foreach ($originaljurusan as $original) {
            $yz = AlumniModel::where('kode_lulus', $request->idtahunlulus)->where('kode_jurusan', $original->id)->count();
            $DataJurusan[] = $yz;
            $LabelJurusan[] = $original->jurusan;
        }
        //Jurusan Database Function
        $datajurusanOriginal = JurusanModel::all();
        //Data Foward Function
        $datajurusanalumni = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = AlumniModel::where('kode_lulus', $request->idtahunlulus)->where('kode_jurusan', $original->id)->count();
            $datajurusanalumni[$original->id] = $yz;
        }
        $dataalumnikuliah = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('id_jurusan', $original->id)->where('pendidikan', 'melanjutkan pendidikan')->count();
            $dataalumnikuliah[$original->id] = $yz;
        }
        $dataalumnibekerja = [];
        foreach ($datajurusanOriginal as $original) {
            $yz = StatusAlumniModel::where('tahun_lulus', $request->idtahunlulus)->where('id_jurusan', $original->id)->where('bekerja', 'bekerja')->count();
            $dataalumnibekerja[$original->id] = $yz;
        }
        return view('admin.laporan.laporantahun', [
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
}
