<?php

namespace App\Http\Controllers;

use App\Notify;
use App\Role;
use App\StaffBoard;
use App\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.staff', [
            'users' => User::all(),
            'roles' => Role::all(),
            'board' => StaffBoard::staff_all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax())
        {
            $user = User::find($id);

            $resp = [
                'title' => $user->role->name,
                'image' => asset($user->image()),
                'name' => $user->name
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
        if ($request->ajax())
        {
            $user = User::find($id);

            $resp = [
                'id' => $user->id,
                'type' => $user->role->id, // чтобы установить селект
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
        if ($request->ajax())
        {
            $this->validate($request, [
                'type' => 'required'
            ]);

            $user = User::find($id);

            $role = $request->get('type');

            $user_role = Role::find($role);
            $user->role()->associate($user_role);
            $user->save();

            $resp = [
                'id' => $user->id,
                'title' => $user_role->name
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
        if ($request->ajax())
        {
            $user = User::find($id);
            $user->board()->delete();
            Storage::delete($user->image);
            $user->delete();
        }
    }
}
