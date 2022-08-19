<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();


        return view('home',compact('users'));
    }

    public function updateUser(Request $request,$id){
        $user_selected = User::findOrFail($id);

        $pass = $request->password;

        $user_selected->name = $request ->name;
        $user_selected->phone = $request ->phone;
        $user_selected->email = $request ->email;
        $user_selected->password = Hash::make($pass);
        $user_selected->rfc = $request ->rfc;

        $user_selected->save();

        return redirect('/home')->with('msj_update','Datos actualizados del Usuario: '.$user_selected->id);


    }
}
