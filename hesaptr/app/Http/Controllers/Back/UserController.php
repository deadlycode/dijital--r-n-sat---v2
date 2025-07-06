<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','<>',Auth::user()->id)->orderByDesc('updated_at')->paginate(100);
        return view('back.users.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            return view('back.users.edit', compact('user'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }
    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null)
        {
            $user->password = bcrypt($request->password);
        }
        $user->wallet = $request->wallet;
        $user->ban = $request->ban;
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.users')->with('success', __('Updated'));
    }
    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }

}
