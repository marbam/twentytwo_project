@extends('layouts.master')

@section('content')

<p>Hello</p>

<a href="/dates/add">Add a new Entry</a>

<?php
    // starting point for now, run with it in live and I'll adapt to a controller if/when I put a summary over several months in.
    $start = \Carbon\Carbon::now();
    $start = $start->startOfMonth();
    $end = \Carbon\Carbon::now();
    $end = $end->endOfMonth();

    $movie_dates = App\Models\DateEntry::
                where('date', '>=', $start)
                ->where('date', '<=', $end)
                ->whereNotNull('movies')
                ->where('movies', '!=', '')
                ->orderBy('date', 'ASC')
                ->get();

    $total = 0;
    $movies = [];
    foreach($movie_dates as $date) {
        $ms = explode(",", $date->movies);
        $total += count($ms);
        $movies[$date->date] = $date->movies;
    }
?>

<h2>Movies this month: {{$total}}</h2>
@foreach($movies as $date => $movies)
    <p>{{\Carbon\Carbon::createFromFormat('Y-m-d', $date)->toFormattedDateString()}} => {{$movies}}</p>
@endforeach

<?php
    $today = \Carbon\Carbon::now()->startOfDay();
    $seven_days_ago = \Carbon\Carbon::now()->subDays(7)->startOfDay();
    $dates_from_last_week = App\Models\DateEntry::
          where('date', '>=', $seven_days_ago)
        ->where('date', '<=', $today)
        ->orderBy('date', 'ASC')
        ->get();

    $recent_days = [];
    for ($i = 0; $i <= 7; $i++) {
        $match = $dates_from_last_week
                  ->where('date', $seven_days_ago->format('Y-m-d'))
                  ->first();

        if ($match) {
            $recent_days[$seven_days_ago->copy()->format('D dS M')] = $match;
        } else {
            $recent_days[$seven_days_ago->copy()->format('D dS M')] = null;
        }

        $seven_days_ago->addDays(1);
    }
?>

<h2>Recent Dates</h2>
<table class="mt-2">
    <thead class="border border-gray-300 rounded bg-gray-200">
        <th>Date</th>
        <th>Entered</th>
        <th>Metrics</th>
    </thead>
    <tbody>
    @foreach($recent_days as $date => $data)
        <tr class="border border-gray-300">
            <td>{{$date}}</td>
            @if(!$data)
                <td class="bg-red-100">No entry</td>
                <td></td>
            @else
                <td class="bg-green-100">Entered</td>
                <td class="flex">
                    @if ($data->exercises)
                        <div class="w-5 h-5 bg-green-500 rounded mr-1"></div>
                    @else
                        <div class="w-5 h-5 bg-red-500 rounded mr-1"></div>
                    @endif
                    @if ($data->exercises)
                        <div class="w-5 h-5 bg-green-500 rounded"></div>
                    @else
                        <div class="w-5 h-5 bg-red-500 rounded"></div>
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

@endsection