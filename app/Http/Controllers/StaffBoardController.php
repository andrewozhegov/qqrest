<?php

namespace App\Http\Controllers;

use App\StaffBoard;
use App\User;
use Illuminate\Http\Request;

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
        User::find($id)->board()->delete();
    }
}
