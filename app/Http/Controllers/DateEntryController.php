<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DateEntry;
use Illuminate\Http\Request;

class DateEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_today()
    {
        $data['date'] = Carbon::today();
        $dateymd = $data['date']->format('Y-m-d');
        $data['entry'] = DateEntry::firstOrCreate(['date' => $dateymd]);
        return view('dates.date', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($y, $m, $d)
    {
        return view('dates.date');
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
     * @param  \App\Models\DateEntry  $dateEntry
     * @return \Illuminate\Http\Response
     */
    public function show(DateEntry $dateEntry)
    {
        return view('dates.date');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DateEntry  $dateEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(DateEntry $dateEntry)
    {
        return view('dates.date');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DateEntry  $dateEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DateEntry $dateEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DateEntry  $dateEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(DateEntry $dateEntry)
    {
        //
    }
}
