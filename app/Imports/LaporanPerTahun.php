<?php

namespace App\Imports;

use App\Models\AlumniModel;
use App\Models\StatusAlumniModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPerTahun implements FromView
{
    /**
    * @param Collection $collection
    */
    public function __construct(string $idjurusan)
    {
        $this->idjurusan = $idjurusan;
    }
    public function view(): View
    {
        $originalalumnidata = AlumniModel::where('kode_jurusanId', $this->idjurusan)->get();
        $statusalumni = [];
        foreach ($originalalumnidata as $original) {
            $status = StatusAlumniModel::where('nisn', $original->nisn)->first();
            $statusalumni[$original->id] = $status;
        }
        return view('admin.exportdata.alltahun', [
            'dataalumni' => $originalalumnidata,
            'statusalumni' => $statusalumni,
        ]);
    }
}
