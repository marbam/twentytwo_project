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
        $data['record'] = DateEntry::firstOrCreate(['date' => $dateymd]);
        $data['heading'] = $data['date']->isoFormat('dddd, MMM Do YYYY');
        return view('dates.date', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($y, $m, $d)
    {
        $data['date'] = Carbon::createFromFormat('Y-m-d', "$y-$m-$d");
        $dateymd = $data['date']->format('Y-m-d');
        $data['record'] = DateEntry::firstOrCreate(['date' => $dateymd]);
        $data['heading'] = $data['date']->isoFormat('dddd, MMM Do YYYY');
        return view('dates.date', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = DateEntry::findOrFail($request->id);
        $texts = ['description', 'highlight', 'movies', 'shows', 'games', 'books'];
        $checks = ['exercises', 'walked'];

        foreach ($texts as $field) {
            if ($request[$field]) {
                $record[$field] = $request[$field];
            }
        }

        foreach ($checks as $field) {
            $record[$field] = 0;
            if ($request[$field]) {
                $record[$field] = 1;
            }
        }

        $record['populated'] = 1;

        $record->save();
        return view('dates.saved');
    }
}
