<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Branch;
use App\Reservation;

class TableController extends Controller
{
    public function show()
    {
        return view('table', [
            'branches' => Branch::all(),
        ]);
    }

    public function reserve(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required'
        ]);

        $reservation = new Reservation([
            'client_name' => $request->get('name'),
            'client_phone' => $request->get('phone'),
            'date_time' => $request->get('date').' '.$request->get('time'),
        ]);

        Branch::find($request->get('address'))->reservations()->save($reservation);

        return redirect('table');

    }
}
