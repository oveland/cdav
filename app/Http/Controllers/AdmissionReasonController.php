<?php

namespace App\Http\Controllers;

use App\AdmissionReason;
use Illuminate\Http\Request;

class AdmissionReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admission_reasons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdmissionReason  $admissionReason
     * @return \Illuminate\Http\Response
     */
    public function show(AdmissionReason $admissionReason = null)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdmissionReason  $admissionReason
     * @return \Illuminate\Http\Response
     */
    public function edit(AdmissionReason $admissionReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdmissionReason  $admissionReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdmissionReason $admissionReason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdmissionReason  $admissionReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdmissionReason $admissionReason)
    {
        //
    }
}
