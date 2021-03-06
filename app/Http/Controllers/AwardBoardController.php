<?php

namespace App\Http\Controllers;

use App\Award;
use App\AwardBoard;

class AwardBoardController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        $board = new AwardBoard();
        $award = Award::find($id);
        $award->board()->save($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('moder')) {
            return redirect('/');
        }

        Award::find($id)->board()->delete();
    }
}
