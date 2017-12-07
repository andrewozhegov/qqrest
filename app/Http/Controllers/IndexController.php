<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\BranchBoard;
use App\Notify;

class IndexController extends Controller
{
    public function show()
    {
        return view('index', [
            'news' => News::all(),
            'branches' => BranchBoard::branch_all(),
            'notifies' => Notify::notifiesToArray()
        ]);
    }
}
