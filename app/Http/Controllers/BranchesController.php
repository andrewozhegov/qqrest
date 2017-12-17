<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Branch;
use App\BranchBoard;
use App\Notify;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        return view('manage.branches', [
            'branches' => Branch::all(),
            'board' => BranchBoard::branch_all(),
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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $this->validate($request, [
                'name' => 'required',
                'title' => 'required',
                'photo' => 'file|image',
                'photo1' => 'file|image'
            ]);

            $name = $request->get('name');
            $address = $request->get('title');
            $photo = 'branches/'.$request->file('photo')->getClientOriginalName();
            $photo1 = 'branches/'.$request->file('photo1')->getClientOriginalName();

            if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
            {
                if (Storage::put($photo1, file_get_contents($request->file('photo1')->getRealPath())))
                {

                    $branch = Branch::create([
                        'name' => $name,
                        'address' => $address,
                        'image' => $photo,
                        'img_big' => $photo1
                    ]);

                    $resp = [
                        'id' => $branch->id,
                        'name' => $branch->name,
                        'address' => $branch->address
                    ];

                    return $resp;
                }

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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $branch = Branch::find($id);

            $resp = [
                'name' => $branch->name,
                'title' => $branch->address,
                'image' => asset($branch->image()),
                'image1' => asset($branch->img_big()),
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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $branch = Branch::find($id);

            $resp = [
                'id' => $branch->id,
                'name' => $branch->name,
                'title' => $branch->address,
                'image' => asset($branch->image()),
                'image1' => asset($branch->img_big())
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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $this->validate($request, [
                'name' => 'required',
                'title' => 'required'
            ]);

            $branch = Branch::find($id);

            if ($request->hasFile('photo'))
            {
                $photo = 'branches/'.$request->file('photo')->getClientOriginalName();
                $photo_old = $branch->image;

                if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
                {
                    $branch->update([
                        'image' => $photo
                    ]);
                    Storage::delete($photo_old);
                }
            }

            if ($request->hasFile('photo1'))
            {
                $photo1 = 'branches/'.$request->file('photo1')->getClientOriginalName();
                $photo1_old = $branch->img_big;

                if (Storage::put($photo1, file_get_contents($request->file('photo1')->getRealPath())))
                {
                    $branch->update([
                        'img_big' => $photo1
                    ]);
                    Storage::delete($photo1_old);
                }
            }

            $name = $request->get('name');
            $address = $request->get('title');

            $branch->update([
                'name' => $name,
                'address' => $address
            ]);

            $resp = [
                'id' => $branch->id,
                'name' => $branch->name,
                'title' => $branch->address
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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        if ($request->ajax())
        {
            $branch = Branch::find($id);
            Storage::delete($branch->image);
            Storage::delete($branch->img_big);
            $branch->delete();
        }
    }
}
