<?php

namespace App\Http\Controllers\ControllersAlumni;

use Illuminate\Http\Request;
use App\Models\ProfileAlumni;
use App\Http\Controllers\Controller;
use App\Models\AlumniModel;

class ProfileAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AlumniModel $alumniModel)
    {
        // $findSiswaProfile = AlumniModel::findOrFail($request->id);
        // return view('admin.daftar.alumni.profilealumni', [
        //     'dataAlumni' => $findSiswaProfile
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AlumniModel $alumniModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
