<?php

namespace App\Http\Controllers;

use App\Models\utsPayment;
use App\Http\Requests\StoreutsPaymentRequest;
use App\Http\Requests\UpdateutsPaymentRequest;

class UtsPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreutsPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreutsPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\utsPayment  $utsPayment
     * @return \Illuminate\Http\Response
     */
    public function show(utsPayment $utsPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\utsPayment  $utsPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(utsPayment $utsPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateutsPaymentRequest  $request
     * @param  \App\Models\utsPayment  $utsPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateutsPaymentRequest $request, utsPayment $utsPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\utsPayment  $utsPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(utsPayment $utsPayment)
    {
        //
    }
}
