<?php

namespace App\Http\Controllers;

use App\Models\AlumniModel;
use App\Models\DudiModel;
use App\Models\JurusanModel;
use App\Models\KepalaSekolahModel;
use App\Models\LowonganModel;
use App\Models\StatusAlumniModel;
use App\Models\TahunLulusModel;
use Illuminate\Http\Request;

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
}
