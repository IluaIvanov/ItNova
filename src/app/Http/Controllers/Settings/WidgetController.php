<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Frequency;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource widget.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'currencies' => Currency::all(["id", "valute_id", "name", "view"]),
            'frequency' => (new Frequency)->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currencyIds = $request->input('currencyIds');
        Currency::where('view', true)->update([
            'view' => false
        ]);
        if (count($currencyIds) !== 0) (new Currency)->whereIn('id', $currencyIds)
            ->update([
                'view' => true
            ]);
    }

    /**
     * Creates or updates the refresh rate of information on the widget tab
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createOrUpdateFrequency(Request $request)
    {
        $validation = $request->validate([
            'frequency' => 'required|integer|between:0,60'
        ]);
        (new Frequency)->set($validation['frequency']);
    }
}
