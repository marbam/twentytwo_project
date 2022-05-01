@extends('layouts.master')

@section('content')

@if(isset($message))
    <p>{{$message}}</p>
@endif

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

@include('dates.recent')

@endsection