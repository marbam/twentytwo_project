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

<h2 class="text-lg font-bold pt-2">Recent Dates</h2>
<table class="mt-2">
    <thead class="border border-gray-300 rounded bg-gray-200">
        <th>Date</th>
        <th>Entered</th>
        <th>Metrics</th>
    </thead>
    <tbody>
    @foreach($recent_days as $date => $data)
        <tr class="border border-gray-300">
            @php
                $carb = \Carbon\Carbon::createFromFormat('D dS M Y', $date.date("Y"));
                $link = "/dates/add/".$carb->format('Y/m/d');
            @endphp
            <td><a href="{{$link}}">{{$date}}</td>
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
                    @if ($data->walked)
                        <div class="w-5 h-5 bg-green-500 rounded mr-1"></div>
                    @else
                        <div class="w-5 h-5 bg-red-500 rounded mr-1"></div>
                    @endif
                    @if ($data->alcohol)
                        <div class="w-5 h-5 bg-red-500 rounded"></div>
                    @else
                        <div class="w-5 h-5 bg-green-500 rounded"></div>
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>