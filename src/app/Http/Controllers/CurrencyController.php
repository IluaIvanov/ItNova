<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Frequency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new Currency)
            ->where('view', true)
            ->with('lastCourse')
            ->get();
    }

    /**
     * Display a listing of the resource frequency.
     *
     * @return \Illuminate\Http\Response
     */

    public function getFrequency()
    {
        return (new Frequency)->get();
    }
}
