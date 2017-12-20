<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notify;

use App\BranchBoard;
use App\ServiceBoard;
use App\AwardBoard;
use App\StaffBoard;

use App\Review;

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
            'notifies' => Notify::notifiesToArray()
        ]);
    }

    public function review(Request $request)
    {
        if($request->ajax())
        {
            $this->validate($request, [
                'comment' => 'required'
            ]);

            $user = Auth::user();

            $review = new Review([
                'text' => $request->get('comment')
            ]);

            $temp = $user->reviews()->save($review);


            $notification = Notify::all()->where('page', '=', 'reviews')->first();
            $notification->update([
                'count' => ++$notification->count
            ]);

            $resp = [
                'user_image' => asset($user->image()),
                'user_name' => $user->name,
                'review_text' => $review->text,
                'review_created_at' => ''.$review->created_at
            ];

            //return redirect('about');
            return $resp;
        }

    }
}
