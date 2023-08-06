<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function showLoginForm()
    {
        return redirect('/');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
	
	public function login(Request $request){
        $request->validate([
			'email'=>'required',
			'password'=>'required',
        ]);
		
		$user = User::where('email', request()->email)->first();

		if ( ! $user) {
			return redirect('/')->with('email_message', 'Email is not exists')
            ->withInput(); // Keep the input data for the form;
		}
		
		else if (Hash::check(request()->password, $user->password)) {
			// The passwords match, log in the user
			Auth::login( $user );
			//save the Login update
			$user = Auth::user();
			return redirect('/companies');
		}
		
		return redirect('/')->with('password_message', 'Invalid password.')
        ->withInput(); // Keep the input data for the form;
	}

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'You have succesfully logout !');
    }
}
