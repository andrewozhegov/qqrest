<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\News;
use App\Notify;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.news', [
            'news' => News::all(),
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
        if ($request->ajax())
        {
            $this->validate($request, [
                'title' => 'required',
                'photo' => 'file|image',
                'text' => 'required'
            ]);

            $title = $request->get('title');
            $photo = 'news/'.$request->file('photo')->getClientOriginalName();
            $text = $request->get('text');

            if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
            {
                $news_id = News::create([
                    'title' => $title,
                    'image' => $photo,
                    'text' => $text
                ])->id;

                $news_obj = News::find($news_id);

                $news = [
                    'id' => $news_obj->id,
                    'title' => $news_obj->title,
                    'image' => asset($news_obj->image()),
                    'text' => $news_obj->text,
                    'created_at' => ''.$news_obj->created_at
                ];

                return $news;
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
            $news = News::find($id);

            $resp = [
                'title' => $news->title,
                'image' => asset($news->image()),
                'text' => $news->text,
                'updated_at' => ''.$news->updated_at
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
            $news = News::find($id);

            $resp = [
                'id' => $news->id,
                'title' => $news->title,
                'image' => asset($news->image()),
                'text' => $news->text
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
                'title' => 'required',
                'text' => 'required'
            ]);

            $news = News::find($id);

            if ($request->hasFile('photo'))
            {
                $photo = 'news/'.$request->file('photo')->getClientOriginalName();
                $photo_old = $news->image;

                if (Storage::put($photo, file_get_contents($request->file('photo')->getRealPath())))
                {
                    $news->update([
                        'image' => $photo
                    ]);
                    Storage::delete($photo_old);
                }
            }

            $title = $request->get('title');
            $text = $request->get('text');

            $news->update([
                'title' => $title,
                'text' => $text
            ]);

                $resp = [
                    'id' => $news->id,
                    'title' => $news->title,
                    'updated_at' => ''.$news->updated_at
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
            $news = News::find($id);
            Storage::delete($news->image);
            $news->delete();
        }
    }
}
