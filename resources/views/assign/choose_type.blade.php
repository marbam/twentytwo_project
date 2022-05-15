@extends('layouts.master')

@section('content')
    <h1 class="text-red-500 text-xl">Choose a gametype!</h1>

    @foreach ($types as $type)
        <button class="type-button bg-gray-200 hover:bg-gray-300 p-3 rounded-lg m-2"
                data-type_id="{{$type->id}}"
                onclick="click_button(this)"
        >
                {{$type->label}}
        </button>
    @endforeach

    <form action="/assign/setup_game" method="POST">
        @csrf
        <input type="hidden" name="type_id" value="" id="type_id">
        <button type="submit"
                id="send"
                class="bg-green-500 text-white p-2 m-2 rounded-lg cursor-not-allowed"
                disabled
        >
            Setup!
        </button>
    </form>

    <script>
        function click_button(button) {

            // SET ALL BUTTONS TO DESELECTED:
            // buttons = document.getElementsByClassName("type-button");
            buttons = document.querySelectorAll('.type-button')
            buttons.forEach(b => {
                b.classList.remove("bg-green-300");
                b.classList.add("bg-gray-200");
                b.classList.add("hover:bg-gray-300");
            });

            // SET THE SELECTED ONE TO ENABLED
            button.classList.add("bg-green-300");
            button.classList.remove("bg-gray-200");
            button.classList.remove("hover:bg-gray-300");

            // SET THE HIDDEN FIELD VALUE
            let id = button.dataset.type_id;
            let input = document.getElementById('type_id');
            input.value = id;

            // REMOVE DISABLED FROM SUBMIT BUTTON
            let submit = document.getElementById('send');
            submit.classList.remove("cursor-not-allowed");
            submit.removeAttribute('disabled');
        }
    </script>

@endsection