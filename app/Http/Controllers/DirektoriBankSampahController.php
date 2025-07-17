<?php

namespace App\Http\Controllers;

use App\Models\DirektoriBankSampah;
use Illuminate\Http\Request;

class DirektoriBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.bank.index');
        //
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
    public function show(DirektoriBankSampah $direktoriBankSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DirektoriBankSampah $direktoriBankSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DirektoriBankSampah $direktoriBankSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DirektoriBankSampah $direktoriBankSampah)
    {
        //
    }
}
