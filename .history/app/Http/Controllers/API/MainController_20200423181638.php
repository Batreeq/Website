<?php

namespace App\Http\Controllers\API;


use App\Homeblocks;
use App\HomeSlider;
use App\Help;
use App\PrivacyPolicy;
use App\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

use App\User;
use App\FamilyMembers;
use App\UserPayments;

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $familyMembers = FamilyMembers::where('user_id', $user->id)->get();
        $UserPayments = UserPayments::where('user_id', $user->id)->get();
        $UserBalance = UserPayments::select('active_balance', 'inactive_balance', 'total_balance')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
        foreach ($UserPayments as $key => $pay) {
			$date = explode("T", $pay->created_at)[0];
			$pay->created_date = explode(" ", $date)[0];
        }

        $categories = Category::all();
        $HomeSliders = HomeSlider::select('image','order')->get();
        $Homeblocks = Homeblocks::all();
        $Help = Help::select('title','text')->get();
        $PrivacyPolicy = PrivacyPolicy::select('title','text')->get();
        $termsAndConditions = Terms::select('title','text')->get();
        return response()->json([
            'categories' => $categories,
            'homeSliders' => $HomeSliders,
            'homeBlocks' => $Homeblocks,
            'HelpScreen' => $Help,
            'PrivacyPolicy' => $PrivacyPolicy,
            'termsAndConditions' => $termsAndConditions,

            'user_info' => $user,
            'family_members' => $familyMembers,
            'user_payments' => $UserPayments,
            'user_balance' => $UserBalance

        ]);
    }

}
