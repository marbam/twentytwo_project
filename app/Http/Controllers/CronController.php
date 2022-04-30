<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CronController extends Controller
{

    public function callEcologiAPI() {

        Log::debug('Retrieving Ecologi Data...');

        $data = json_decode(file_get_contents('https://public.ecologi.com/users/'.env('ECOLOGI_USERNAME').'/impact'), true);
        if ($data['trees']) {
            Setting::firstOrCreate(
                ['key' => 'number_trees'],
                ['value' => $data['trees']],
            );
        }

        if ($data['carbonOffset']) {
            Setting::firstOrCreate(
                ['key' => 'carbon_offset'],
                ['value' => $data['carbonOffset']],
            );
        }

        Log::debug('Ecologi Data Retrieved...');
    }

}
