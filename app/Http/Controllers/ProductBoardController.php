<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Product;
use App\ProductBoard;

class ProductBoardController extends Controller
{
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

        $board = new ProductBoard();
        $award = Product::find($id);
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
        if (Gate::denies('staff')) {
            return redirect('/');
        }

        Product::find($id)->board()->delete();
    }
}
