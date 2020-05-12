<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\User;
use App\FamilyMembers;
use App\UserPayments;
use App\UserStatistics;
use App\UserMessages;
use App\PointsProducts;
use App\PointsReplace;
use App\Points;

class UsersController extends Controller
{
    // get all user information , by Access Token
    public function userInfo(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $familyMembers = FamilyMembers::where('user_id', $user->id)->get();
        return response()->json([
            'user_info' => $user,
            'family_members' => $familyMembers,
        ]);
    }

    // get users points , by Access Token
    public function userPoints(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        return response()->json([
            'user_points' => $user->points,
        ]);
    }

    // get all user payment information and balance, by Access Token
    public function userBalance(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $UserPayments = UserPayments::where('user_id', $user->id)->get();
        $UserBalance = UserPayments::select('active_balance', 'inactive_balance', 'total_balance')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
        foreach ($UserPayments as $key => $pay) {
			$date = explode("T", $pay->created_at)[0];
			$pay->created_date = explode(" ", $date)[0];
        }
        return response()->json([
            'user_payments' => $UserPayments,
            'user_balance' => $UserBalance
        ]);
    }

    // Register new user
    public function register(Request $request)
    {
        $points = Points::all();
        if($request->get('api_token') == ''){
            $ifUser = User::where('phone', $request->get('phone'))->first();
			if($ifUser){
				return response()->json(['user'=>$ifUser]);
			}
            $image = $request->get('image');  // your base64 encoded
          //$image = str_replace('data:image/png;base64,', '', $image);
		  //$image = str_replace('data:image/jpeg;base64,', '', $image);
          //$image = str_replace(' ', '+', $image);
            $imageName = 'User_Pic_'.$request->get('phone') . '.png';
            // add image to public folder

			file_put_contents(public_path('/images/').$imageName, base64_decode($image));

            $user = new User;
            $user->phone = $request->get('phone');
            $user->image = 'https://jaraapp.com/images/'.$imageName;
            $user->email = $request->get('email');
			$user->name = $request->get('name');
            $user->location = $request->get('location');
            $user->api_token = hash('sha256', Str::random(60));
            $user->save();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $userData = User::find($user->id);

            $user_statistics = new UserStatistics;
            $user_statistics->user_id = $user->id;
            $user_statistics->using_count = 1;
            $user_statistics->using_months = 0;
            $user_statistics->using_avg = 1;
            $user_statistics->purchase_count = 0;
            $user_statistics->purchase_months = 0;
            $user_statistics->purchase_avg = 0;
            $user_statistics->purchase_amount = 0;
            $user_statistics->start_date = date('Y-m-d');
            $user_statistics->save();

            return response()->json(['user'=>$userData]);
        } else {
            $user = User::where('api_token', $request->get('api_token'))->first();
            $image = $request->get('image');  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
			$image = str_replace('data:image/jpeg;base64,', '', $image);
            $imageName = $request->get('phone') . '.png';
            // add image to public folder
            file_put_contents(public_path('/images/').$imageName, base64_decode($image));

            $user->phone = $request->get('phone');
            $user->image = 'https://jaraapp.com/images/'.$imageName;
            $user->email = $request->get('email');
			$user->name = $request->get('name');
            $user->location = $request->get('location');
            $user->salary = $request->get('salary');
            $user->save();
            return response()->json(['user'=>$user]);
        }
    }

    // Add Family Members Function
    public function addFamilyMember(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $familyMembers = new FamilyMembers;
        $familyMembers->user_id = $user->id;
        $familyMembers->name = $request->get('name');
        $familyMembers->gender = $request->get('gender');
        $familyMembers->age = $request->get('age');
        $familyMembers->save();
        $user->salary = $request->get('salary') ? $request->get('salary') : 0;
        $user->save();
        $addFamily = Points::find();
        return response()->json(['success'=>$familyMembers]);
    }

     // Function to add users messages
    public function addMessage(Request $request)
    {
         $user = User::where('api_token', $request->get('api_token'))->first();
         $User_messages = new UserMessages;
         $User_messages->user_id = $user->id;
         $User_messages->user_image = $user->image;
         $User_messages->message = $request->get('message');
         $User_messages->date = date('Y-m-d');
         $User_messages->time = date('h:i A');
         $User_messages->save();

         $chat_bot = array("message" => "test response", "date" => date('Y-m-d'), "time" => date('h:i A'));
         return response()->json(['User_message'=>$User_messages, 'bot_response' => $chat_bot]);
    }

    // Function to add users messages
    public function getMessages(Request $request)
    {
         $user = User::where('api_token', $request->get('api_token'))->first();
         $messages = UserMessages::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(25);
         return $messages;
    }

    // Function to get Points Products
    public function getPointsProducts(Request $request)
    {
         $PointsProducts = PointsProducts::all();
         return response()->json(['points_products'=>$PointsProducts]);
    }

    // Function to replce users Points with products
    public function replcePoints(Request $request)
    {
        $user = User::where('api_token', $request->get('api_token'))->first();
        $PointsProducts = PointsProducts::find($request->get('points_poduct'));
        $points_replace = new PointsReplace;
         $points_replace->user_id = $user->id;
         $points_replace->points_product_id = $PointsProducts->id;
         $points_replace->points_count = $PointsProducts->points;
         $points_replace->save();

         $user->points = (int) $user->points - (int) $PointsProducts->points;
         $user->save();
        return response()->json(['points_replace'=>$points_replace]);
    }

}
