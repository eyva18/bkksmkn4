<?php

namespace App\Http\Controllers\ControllersAdmin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use App\Imports\PerusahaanImport;
use App\Models\StatusImportModel;
use App\Models\TahunLulusModel;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{
    public function index(){
        return view('admin.master-page.import.index', [
            'dataTahunlulus' => TahunLulusModel::all(),
            'statusImport' => StatusImportModel::all()
        ]);
    }
    public function downloadformatalumni(){
        $file= public_path(). "/file/"."alumni-import.xlsx";
        return Response::download($file, "alumni-import.xlsx");
    }
    public function downloadformatperusahaan(){
        $file= public_path(). "/file/"."perusahaan.xlsx";
        return Response::download($file, "perusahaan.xlsx");
    }
    public function importdataexcel(Request $request){
        if ($request->tipe_import == "alumni") {
            Excel::import(new AlumniImport, $request->file('fileimport')->store('temp'));
            StatusImportModel::create([
                'waktu' => now(),
                'tipe' => "Import Alumni - Excel File",
                'status' => "Success",
                'deskripsi' => "Berhasil Melakukan Import Data Alumni",
            ]);
            return redirect('/admin/administrator/master/import')->with('success', 'Import Data Alumni Success !!!');
        }
        elseif($request->tipe_import == null){
            return redirect('/admin/administrator/master/import');
        }
        elseif($request->tipe_import == "perusahaan"){
            Excel::import(new PerusahaanImport, $request->file('fileimport')->store('temp'));
            StatusImportModel::create([
                'waktu' => now(),
                'tipe' => "Import Perusahaan - Excel File",
                'status' => "Success",
                'deskripsi' => "Berhasil Melakukan Import Data Perusahaan",
            ]);
            return redirect('/admin/administrator/master/import')->with('success', 'Import Data Alumni Success !!!');
        }
    }
}
