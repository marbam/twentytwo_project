@extends('layouts.master')

@section('content')

    @foreach($data['cards_types'] as $type)
        <h1>{{$type->name}}</h1>
        <div class="grid grid-cols-4 gap-1 w-3/5">
            @foreach ($data['available_cards'] as $card)
                @if ($card->card_type_id == $type->id)
                    @php
                        $classes = "bg-blue-300 hover:bg-blue-400";
                        if(in_array($card->id, $data['selected_cards'])) {
                            $classes = "bg-green-300 hover:bg-green-400 font-semibold";
                        }
                    @endphp
                    <div
                        class="w-44 p-4 mx-2 rounded-xl text-center {{$classes}}"
                        onclick="handleClick(this)"
                        id="button-{{$card->id}}"
                        data-id="{{$card->id}}"
                    >
                        {{$card->name}}
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach

    <form method="POST" action="/assign/submit_cards/{{$data['game_id']}}">
        @csrf
        <input type="hidden" id="selectedIdsField" name="cards" />
        <button
            class="w-24 p-4 m-4 bg-green-600 hover:bg-green-500 text-white rounded-xl"
            type="submit">Submit</button>
    </form>

@endsection

<script>
    let selectedIds = [];
    function handleClick(button) {
        let id = button.dataset.id;
        if (!selectedIds.includes(id)) {
            selectedIds.push(id);
        } else {
            selectedIds = selectedIds.filter(function(value) {
                return value !== id
            })
        }
        button.classList.toggle('bg-blue-300');
        button.classList.toggle('hover:bg-blue-400');
        button.classList.toggle('bg-green-300');
        button.classList.toggle('hover:bg-green-400');
        button.classList.toggle('font-semibold');
        let idString = selectedIds.toString();
        document.getElementById('selectedIdsField').value=idString;
    }
</script>