<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

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
        if (Gate::denies('admin')) {
            return redirect('/');
        }

        Branch::find($id)->board()->delete();
    }
}
