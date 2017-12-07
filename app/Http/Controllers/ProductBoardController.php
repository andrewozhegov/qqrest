<?php

namespace App\Http\Controllers;

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
        Product::find($id)->board()->delete();
    }
}
