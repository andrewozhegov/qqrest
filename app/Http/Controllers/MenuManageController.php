<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Notify;
use App\Product;
use App\ProductType;
use App\ProductBoard;

class MenuManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.menu', [
            'products' => Product::all(),
            'types' => ProductType::all(),
            'board' => ProductBoard::products_all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $this->validate($request, [
                'name' => 'required',
                'photo' => 'file|image',
                'photo1' => 'file|image',
                'type' => 'required',
                'count' => 'required',
                'price' => 'required'
            ]);

            $name = $request->get('name');
            $photo = 'products/'.$request->file('photo')->getClientOriginalName();
            $photo1 = 'products/'.$request->file('photo1')->getClientOriginalName();
            $type = $request->get('type');
            $count = $request->get('count');
            $price = $request->get('price');

            if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
            {
                if (Storage::put($photo1, file_get_contents($request->file('photo1')->getRealPath())))
                {
                    $product_type = ProductType::find($type);

                    $product = new Product([
                        'name' => $name,
                        'image' => $photo,
                        'image_big' => $photo1,
                        'count' => (int)$count,
                        'price' => (int)$price,
                        'text' => ''
                    ]);

                    $product_id = $product_type->products()->save($product)->id;

                    $product_obj = Product::find($product_id);

                    $resp = [
                        'id' => $product_obj->id,
                        'name' => $product_obj->name,
                        'count' => $product_obj->count
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
        if ($request->ajax())
        {
            $product = Product::find($id);

            $resp = [
                'type' => $product->type->type_name,
                'image' => asset($product->image()),
                'image1' => asset($product->image_big()),
                'price' => $product->price,
                'name' => $product->name
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
            $product = Product::find($id);

            $resp = [
                'id' => $product->id,
                'type' => $product->type->id, // чтобы установить селект
                'image' => asset($product->image()),
                'image1' => asset($product->image_big()),
                'count' => $product->count,
                'price' => $product->price,
                'name' => $product->name
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
                'name' => 'required',
                'photo' => 'image',
                'photo1' => 'image',
                'type' => 'required',
                'count' => 'required',
                'price' => 'required'
            ]);

            $product = Product::find($id);

            if ($request->hasFile('photo'))
            {
                $photo = 'products/'.$request->file('photo')->getClientOriginalName();
                $photo_old = $product->image;

                if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
                {
                    $product->update([
                        'image' => $photo
                    ]);
                    Storage::delete($photo_old);
                }
            }

            if ($request->hasFile('photo1'))
            {
                $photo1 = 'products/'.$request->file('photo1')->getClientOriginalName();
                $photo1_old = $product->image_big;

                if (Storage::put($photo1, file_get_contents($request->file('photo1')->getRealPath())))
                {
                    $product->update([
                        'image_big' => $photo1
                    ]);
                    Storage::delete($photo1_old);
                }
            }

            $name = $request->get('name');
            $type = $request->get('type');
            $count = $request->get('count');
            $price = $request->get('price');

            $product->update([
                'name' => $name,
                'count' => (int)$count,
                'price' => (int)$price
            ]);

            $product_type = ProductType::find($type);
            $product->type()->associate($product_type);
            $product->save();

            $resp = [
                'id' => $product->id,
                'name' => $product->name,
                'count' => $product->count
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
            $product = Product::find($id);
            $product->board()->delete();
            Storage::delete($product->image);
            Storage::delete($product->image_big);
            $product->delete();
        }
    }
}
