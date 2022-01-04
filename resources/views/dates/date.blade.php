<h1>Date: {{ $data['heading'] }}</h1>

@php
    $prev = $data['date']->clone()->subDays(1);
    $next = $data['date']->clone()->addDays(1);
@endphp

<a href="/dates/add/{{$prev->format('Y/m/d')}}"><< {{ $prev->isoFormat('ddd Do MMM') }}</a>
<a href="/dates/add/{{$next->format('Y/m/d')}}">   {{ $next->isoFormat('ddd Do MMM') }} >></a>

<form method="POST">

    @csrf
    <input type="hidden" name="id" value={{ $data["record"]["id"] }}>

    <label for="description">Brief Description</label>
    <textarea name="description" id="description"></textarea>
    <br>

    <label for="highlight">Highlight</label>
    <textarea name="highlight" id="highlight"></textarea>
    <br>

    <label for="movies">Movies</label>
    <textarea name="movies" id="movies"></textarea>
    <br>

    <label for="shows">Shows</label>
    <textarea name="shows" id="shows"></textarea>
    <br>

    <label for="games">Games</label>
    <textarea name="games" id="games"></textarea>
    <br>

    <label for="books">Books</label>
    <textarea name="books" id="books"></textarea>
    <br>

    <label for="exercises">Did Exercises</label>
    <input type="checkbox" name="exercises" id="exercises" />
    <br>

    <label for="walked">Went for Walk</label>
    <input type="checkbox" name="walked" id="walked" />

    <br>
    <button type="submit">Save</button>
</form>