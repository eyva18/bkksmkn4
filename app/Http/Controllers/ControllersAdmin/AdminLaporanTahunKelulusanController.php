<?php

namespace app\Http\Controllers\ControllersAdmin;

use App\Imports\LaporanPerTahun;
use App\Imports\LaporanPickTahunan;
use App\Models\DudiModel;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Illuminate\Http\Request;
use App\Models\LowonganModel;
use App\Models\StatusAlumniModel;
use App\Models\TahunLulusModel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminLaporanTahunKelulusanController extends Controller
{
    public function index()
    {
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
        if($request->idtahunlulus == null){
            return redirect('/admin/administrator/master/report/yearly');
        }
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
        return view('admin.laporan.laporanpertahun', [
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
        return view('admin.laporan.detailalltahun', [
            'DataChartStatus' => ($DataChartStatus),
            'jurusandata' => JurusanModel::find($idjurusan),
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,

        ]);
    }

    public function detail_laporan_perjurusan_pertahun(TahunLulusModel $tahun_lulus, $idjurusan)
    {
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
        return view('admin.laporan.detailpertahun', [
            'DataChartStatus' => ($DataChartStatus),
            'jurusandata' => JurusanModel::find($idjurusan),
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,
            'tahunlulusdata' => TahunLulusModel::where('tahun_lulus', $tahun_lulus->tahun_lulus)->first(),

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
}
