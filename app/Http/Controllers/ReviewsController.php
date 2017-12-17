<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Review;
use App\Notify;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        Notify::all()->where('page', '=', 'reviews')->first()->update(['count' => 0]);

        return view('manage.reviews', [
            'reviews' => Review::all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $item = Review::find($id);

            $resp = [
                'id' => $item->id,
                'text' => $item->text
            ];

            return $resp;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $this->validate($request, [
                'text' => 'required'
            ]);

            $item = Review::find($id);

            $text = $request->get('text');

            $item->update([
                'text' => $text
            ]);

            $resp = [
                'id' => $item->id,
                'text' => $item->text,
                'updated_at' => ''.$item->updated_at
            ];

            return $resp;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            Review::find($id)->delete();
        }
    }
}
