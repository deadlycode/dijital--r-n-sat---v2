<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if (Auth::user()->ban == 1) {
            print_r('You are banned.');
            return redirect()->back()->with('error', __('You are banned.'));
        }
        if (session()->get('favorite')) {
            foreach (session()->get('favorite') as $data) {
                Favorite::firstOrCreate([
                    'user_id' => auth()->user()->id,
                    'product_id' => $data,
                ]);
            }
        }
        Auth::user()->update([
            'ip' => request()->ip(),
        ]);
        return url()->previous();
    }

    protected function logout()
    {
        // do what ever you want.
        //Log::insert(['user_id' => Auth::id(), 'ip' => request()->ip(), 'content' => Auth::user()->name . ' ' . Auth::user()->surname . ' logged out.']);
        Auth::logout();
        return redirect()->back()->with('success', __('You are logged out.'));
        //dd('logout');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $user = User::firstOrCreate([
            'email' => $user->email,

        ], [
            'name' => $user->name,
            'password' => Hash::make(random_bytes(16)),

        ]);
        Auth::login($user);
        Auth::user()->update([
            'ip' => request()->ip(),
            'google_id' => 1,
        ]);
        return redirect()->back()->with('success', __('You are logged in.'));

    }
}
