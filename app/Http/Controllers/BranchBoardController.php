<?php

namespace App\Http\Controllers;

use App\Branch;
use App\BranchBoard;

class BranchBoardController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $board = new BranchBoard();
        $brunch = Branch::find($id);
        $brunch->board()->save($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->board()->delete();
    }
}
