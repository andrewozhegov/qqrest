<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\BranchBoard;

class IndexController extends Controller
{
    public function show()
    {
        return view('index', [
            'news' => News::all(),
            'branches' => BranchBoard::branch_all()
        ]);
    }
}
