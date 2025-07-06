<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('front.profile.profile');
    }
    public function edit_profile_info_update(Request $request)
    {
        $user = Auth::user();
        $user->name =   $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return back()->with('success', __('Updated'));
    }
    public function edit_profile_password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:20|confirmed',
            'new_password_confirmation' => 'required|min:8|max:20',
        ]);
        $user = Auth::user();
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $new_password_confirmation = $request->new_password_confirmation;

        if ($old_password && $new_password && $new_password_confirmation) {
            if (Hash::check($old_password, $user->password)) {
                $user->password = Hash::make($new_password);
                if ($user->save()) {
                    return redirect()->back()->with('success', __('Password Updated'));
                } else {
                    return redirect()->back()->with('error', __('An Unknown Error Occurred. Please Try Again'));
                }
            } else {
                return redirect()->back()->with('error', __('Old Password is Wrong'));
            }
        } else {
            return redirect()->back()->with('error', __('Please Fill All Fields'));
        }
    }
    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('wallet', null)->where('payment_status',1)->orderByDesc('updated_at')->paginate(50);
        return view('front.profile.orders', compact('orders'));
    }
    public function wallets()
    {
        $wallet = Order::where('user_id', Auth::user()->id)->where('payment_status', 1)->where('wallet', 1)->orderByDesc('id')->paginate(100);
        return view('front.profile.wallets', compact('wallet'));
    }

}
