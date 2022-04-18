@extends('layouts.master')

@section('content')

<h1 class="text-lg font-bold pb-2">Saved!</h1>
<a href="/dates"> Back to Dates<a>

@include('dates.recent')
@endsection