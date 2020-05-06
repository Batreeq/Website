<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
         // return view('users.index', ['users' => $model->paginate(15)]);
        return  view('pages.users',['users' => User::all()]);
    }
    public function admin_add_screen()
    {    
        $users_admin= User::where('role','=','admin')->get();
        return view('pages.admin-add',["users_admin"=> $users_admin]);
    }
    public function remove_admin($user){
        User::where('id', '=', $user)->delete();
        return back()->with('success','تم حذف الأدمن بشكل ناجح');

    }
    public function add_admin(Request $request){
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $user = new User;
        $user->name = $request->name;
        $user->created_at= date("Y-m-d h:i:s");
        $user->updated_at= date("Y-m-d h:i:s");
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->phone=$request->phone;
        $user->image=$imageName;
        $user->role="admin";

        $user->save();
                     

        return back()->with('success','تم إضافة الأدمن بشكل ناجح');
        
    }
}
