<?php

namespace App\Http\Controllers;

use App\Models\SetoranSampah;
use Illuminate\Http\Request;

class SetoranSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setoran.index');
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
    public function show(SetoranSampah $setoranSampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SetoranSampah $setoranSampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SetoranSampah $setoranSampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SetoranSampah $setoranSampah)
    {
        //
    }
}
