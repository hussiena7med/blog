<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:users|required',
            'first_name' => 'max:120|required',
            'password' => 'required|min:4'
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;

        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['Username or password is incorrect.']);

    }

    public function getLogout()
    {

        Auth::logout();
        return redirect()->route('home');
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'max:120|required',
        ]);
        $user=Auth::user();
        $user->first_name=$request['first_name'];
        $user->update();

        $file=$request->file('image');
        $filename=$request['first_name'].'-'.$user->id.'.jpg';
        if ($file){
            Storage::disk('local')->put($filename,\Illuminate\Support\Facades\File::get($file));
        }
        return redirect()->route('account');
    }

    public  function getUserImage($filename){
        $file=Storage::disk('local')->get($filename);
        return new Response($file,200);
    }

    public function getAccount(){
        return view('account',['user'=>Auth::user()]);
    }


}