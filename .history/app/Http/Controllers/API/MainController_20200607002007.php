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
use App\UserLogs;
use App\UserStatistics;
use App\Media;
use App\Points;
use App\Posts;
use App\Product;

class MainController extends Controller
{
    // get all needed data for app in splash screen
    public function splashScreen(Request $request)
    {
        if($request->get('api_token')){
            $user = User::where('api_token', $request->get('api_token'))->first();
            $familyMembers = FamilyMembers::where('user_id', $user->id)->get();
            $UserPayments = UserPayments::where('user_id', $user->id)->get();
            $points = Points::all();
            $posts = Posts::all();
			foreach ($posts as $key => $post) {
                $p = Product::find($post->product_id);
				$post->product_details = $p;
            }
            $UserBalance = UserPayments::select('active_balance', 'inactive_balance', 'total_balance')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
			if(!$UserBalance){
			    $UserBalance = '0';
			}
            foreach ($UserPayments as $key => $pay) {
                $date = explode("T", $pay->created_at)[0];
                $pay->created_date = explode(" ", $date)[0];
            }

            $user_logs = new UserLogs;
            $user_logs->user_id = $user->id;
            $user_logs->details = 'قام بفتح التطبيق';
            $user_logs->save();

            $user_statistics = UserStatistics::where('user_id', $user->id)->first();
            if($user_statistics){
                $user_statistics->using_count = (int) $user_statistics->using_count + 1;
                $date = strtotime($user_statistics->start_date);
                $date2 = strtotime(date("Y-m-d"));
                $diff = $date2 - $date;
                $user_statistics->using_months = ceil($diff/60/60/24/30);
                $user_statistics->using_avg = $user_statistics->using_months == 0 ? $user_statistics->using_count / 1 : $user_statistics->using_count / $user_statistics->using_months;
                $user_statistics->save();
            }

        } else {
            $user = '';
            $familyMembers = '';
            $UserPayments = '';
            $UserBalance = '0';
            $points = Points::all();
            $posts = Posts::all();
			foreach ($posts as $key => $post) {
                $p = Product::find($post->product_id);
				$post->product_details = $p;
            }
        }



        $HomeSliders = HomeSlider::select('image','order')->get();
        $Homeblocks = Homeblocks::all();
        foreach ($Homeblocks as $key => $block) {
            $categories = Category::where('home_blocks', $block->id)->get();
        }
        $Help = Help::select('title','image','text')->get();
        $PrivacyPolicy = PrivacyPolicy::select('title','image','text')->get();
        $termsAndConditions = Terms::select('title','image','text')->get();



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
            'user_balance' => $UserBalance,
			'increase_points' => $points,
            'posts' => $posts,
        ]);
    }

    // get Media for different sections
    public function getMedia(Request $request)
    {
        $images = Media::where('section', $request->get('section'))->get();
        return response()->json(['images' => $images]);
    }

}
