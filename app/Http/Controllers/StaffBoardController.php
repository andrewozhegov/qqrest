<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\StaffBoard;
use App\User;

class StaffBoardController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        $board = new StaffBoard();
        $user = User::find($id);
        $user->board()->save($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        User::find($id)->board()->delete();
    }
}
