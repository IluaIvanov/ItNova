<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\RequestCBR;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource setting script.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new RequestCBR)->getSetting();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return (new RequestCBR)->setSetting($request->input('currencyIds'));
    }
}
