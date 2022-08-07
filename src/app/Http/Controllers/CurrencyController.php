<?php

namespace App\Http\Controllers;

use App\Models\currencies;
use App\Service\RequestData;
use App\Service\Setting\RequestCBR;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return print_r((new RequestCBR)->getSetting());
        // $requestData = new RequestData;
        // return $requestData->parseXML();
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
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    // public function show(currencies $currencies)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    // public function edit(currencies $currencies)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, currencies $currencies)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\currencies  $currencies
     * @return \Illuminate\Http\Response
     */
    // public function destroy(currencies $currencies)
    // {
    //     //
    // }
}
