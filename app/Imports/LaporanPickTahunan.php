<?php

namespace App\Imports;

use App\Models\AlumniModel;
use App\Models\StatusAlumniModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPickTahunan implements FromView
{
    /**
    * @param Collection $collection
    */
    public function __construct(string $tahunlulus, string $idjurusan)
    {
        $this->idjurusan = $idjurusan;
        $this->tahunlulus = $tahunlulus;

    }
    public function view(): View
    {
        $originalalumnidata = AlumniModel::where('kode_jurusanId', $this->idjurusan)->where('kode_lulusId', $this->tahunlulus)->get();
        $statusalumni = [];
        foreach ($originalalumnidata as $original) {
            $status = StatusAlumniModel::where('nisn_alumni', $original->nisn)->first();
            $statusalumni[$original->id] = $status;
        }
        return view('admin.exportdata.alltahun', [
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,
        ]);
    }
}
