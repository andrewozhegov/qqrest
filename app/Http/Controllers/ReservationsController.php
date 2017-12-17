<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Notify;
use App\Reservation;
use Illuminate\Http\Request;
use App\Branch;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        Notify::all()->where('page', '=', 'reservations')->first()->update(['count' => 0]);

        return view('manage.reservations', [
            'reservations' => Reservation::all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        $reservation = Reservation::find($id);

        $reservation->update([
            'done' => 1
        ]);

        return $reservation->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $reservation = Reservation::find($id);
            $reservation->delete();
        }
    }
}
