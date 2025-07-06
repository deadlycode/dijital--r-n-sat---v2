<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::user()->id)->pluck('product_id')->all();
            $favorites = Product::whereIn('id', $favorites)->get();
        } else {
            $favorites = $request->session()->get('favorite', []);
            $favorites = Product::whereIn('id', $favorites)->get();
        }
        return view('front.partials.favorite', compact('favorites'));
    }

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if (Auth::check()) {
            $favorite = Favorite::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
            if ($favorite) {
                return response()->json(['status' => 'error', 'message' => __('Already in Favorite')]);
            }else{
                $favorite = new Favorite();
                $favorite->user_id = Auth::user()->id;
                $favorite->product_id = $product->id;
                $favorite->save();
                return response()->json(['status' => 'success', 'message' => __('Added to Favorite')]);
            }
            
            if ($favorite->wasRecentlyCreated) {
                return response()->json(['status' => 'success', 'message' => __('Added to Favorite')]);
            } else {
                return response()->json(['status' => 'error', 'message' => __('Already in Favorite')]);
            }
        } else {
            $favorite = session()->get('favorite', []);
            if (isset($favorite[$product->id])) {
                return response()->json(['status' => 'error', 'message' => __('Already in Favorite')]);
            } else {
                session()->put('favorite.' . $product->id, $product->id);
                return response()->json(['status' => 'success', 'message' => __('Added to Favorite')]);
            }
        }

    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $favorite = Favorite::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->delete();
            $favorites = Favorite::where('user_id', Auth::user()->id)->pluck('product_id')->all();
            $favorites = Product::whereIn('id', $favorites)->get();
        } else {
            session()->pull('favorite.' . $request->product_id);
            $favorites = $request->session()->get('favorite', []);
            $favorites = Product::whereIn('id', $favorites)->get();
        }
        return view('front.partials.favorite', compact('favorites'));
    }
}
