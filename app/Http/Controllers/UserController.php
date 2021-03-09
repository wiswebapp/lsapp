<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::paginate(10);
        return view('users.index')->with('data',$data);
    }

    public function update(StoreUser $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect('/profile')->with('success','Profile Updated Successfully');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/profile')->with('success','Password Updated Successfully');
    }
}
