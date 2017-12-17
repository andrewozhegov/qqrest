<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Award;
use App\AwardBoard;
use App\Notify;

class AwardsController extends Controller
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

        return view('manage.awards', [
            'awards' => Award::all(),
            'board' => AwardBoard::award_all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $this->validate($request, [
                'name' => 'required',
                'photo' => 'file|image',
            ]);

            $name = $request->get('name');
            $photo = 'awards/'.$request->file('photo')->getClientOriginalName();

            if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
            {
                $award_id = Award::create([
                    'name' => $name,
                    'image' => $photo,
                ])->id;

                $award_obj = Award::find($award_id);

                $award = [
                    'id' => $award_obj->id,
                    'name' => $award_obj->name,
                    'image' => asset($award_obj->image()),
                    'created_at' => ''.$award_obj->created_at
                ];

                return $award;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $award = Award::find($id);

            $resp = [
                'name' => $award->name,
                'image' => asset($award->image()),
                'updated_at' => $award->updated_at
            ];

            return $resp;
        }
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
            $award = Award::find($id);

            $resp = [
                'id' => $award->id,
                'name' => $award->name,
                'image' => asset($award->image())
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
                'name' => 'required'
            ]);

            $award = Award::find($id);

            if ($request->hasFile('photo'))
            {
                $photo = 'awards/'.$request->file('photo')->getClientOriginalName();
                $photo_old = $award->image;

                if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
                {
                    $award->update([
                        'image' => $photo
                    ]);
                    Storage::delete($photo_old);
                }
            }

            $name = $request->get('name');

            $award->update([
                'name' => $name
            ]);

            $resp = [
                'id' => $award->id,
                'name' => $award->name,
                'updated_at' => ''.$award->updated_at
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
            $award = Award::find($id);
            $award->board()->delete();
            Storage::delete($award->image);
            $award->delete();
        }
    }
}
