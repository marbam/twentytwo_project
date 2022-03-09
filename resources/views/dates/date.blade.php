@extends('layouts.master')

@section('content')
    <div class="w-80 bg-green-300">
        <h1 class="text-xl">Date: {{ $data['heading'] }}</h1>

        @php
            $prev = $data['date']->clone()->subDays(1);
            $next = $data['date']->clone()->addDays(1);
        @endphp

        <a class="bg-blue-500 text-white rounded p-1 m-1" href="/dates/add/{{$prev->format('Y/m/d')}}"><< {{ $prev->isoFormat('ddd Do MMM') }}</a>
        <a class="bg-blue-500 text-white rounded p-1 m-1" href="/dates/add/{{$next->format('Y/m/d')}}">   {{ $next->isoFormat('ddd Do MMM') }} >></a>

        <form method="POST">

            @csrf
            <input type="hidden" name="id" value={{ $data["record"]["id"] }}>

            <label for="description" class="form-label inline-block mb-2 text-gray-700">Description</label>
            <textarea
            id="description"
            name="description"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->description}}</textarea>

            <label for="highlight" class="form-label inline-block mb-2 text-gray-700">Highlight</label>
            <textarea
            id="highlight"
            name="highlight"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->highlight}}</textarea>

            <label for="movies" class="form-label inline-block mb-2 text-gray-700">Movies</label>
            <textarea
            id="movies"
            name="movies"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->movies}}</textarea>

            <label for="shows" class="form-label inline-block mb-2 text-gray-700">Shows</label>
            <textarea
            id="shows"
            name="shows"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->shows}}</textarea>

            <label for="games" class="form-label inline-block mb-2 text-gray-700">Games</label>
            <textarea
            id="games"
            name="games"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->games}}</textarea>

            <label for="books" class="form-label inline-block mb-2 text-gray-700">Books</label>
            <textarea
            id="books"
            name="books"
            class="form-control block w-full px-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
            >{{$data['record']->books}}</textarea>

            <label for="exercises">Did Exercises</label>
            <input
                class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="checkbox" name="exercises" id="exercises" {{$data['record']->exercises ? 'checked' : null }}
            />
            <br>

            <label for="walked">Went for Walk</label>
            <input
                class="h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="checkbox" name="walked" id="walked" {{$data['record']->walked ? 'checked' : null }}
            />

            <br>
            <button class="bg-blue-500 text-white rounded p-1 m-1" type="submit">Save</button>
        </form>

    </div>





@endsection