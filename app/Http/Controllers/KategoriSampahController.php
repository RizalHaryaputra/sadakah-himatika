<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.kategori.index');
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
    public function show(KategoriSampah $kategoriSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriSampah $kategoriSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriSampah $kategoriSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriSampah $kategoriSampah)
    {
        //
    }
}
