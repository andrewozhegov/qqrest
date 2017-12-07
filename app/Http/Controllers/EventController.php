<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notify;

class EventController extends Controller
{
    public function show()
    {
        return view('event', [
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    public function reserve(Request $request)
    {

    }
}
