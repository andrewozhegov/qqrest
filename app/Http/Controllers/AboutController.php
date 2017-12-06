<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\BranchBoard;
use App\ServiceBoard;
use App\AwardBoard;
use App\StaffBoard;

use App\Review;
use App\Notify;

class AboutController extends Controller
{
    public function show()
    {
        return view('about', [
            'branches' => BranchBoard::branch_all(),
            'services' => ServiceBoard::service_all(),
            'awards' => AwardBoard::award_all(),
            'staffs' => StaffBoard::staff_all(),
            'reviews' => Review::all(),
        ]);
    }

    public function review(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $review = new Review([
            'text' => $request->get('comment')
        ]);

        Auth::user()->reviews()->save($review);

        $notification = Notify::all()->where('page', '=', 'reviews')->first();
        $notification->update([
            'count' => ++$notification->count
        ]);

        return redirect('about');
    }
}
