<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DB;
class IndexController extends Controller
{
    public function index()
    {
        $total_earnings_today = Order::where('payment_status', 1)->whereDate('created_at', today())->sum('total');
        $total_orders_today = Order::whereDate('created_at', today())->count();
        $total_contacts_today = DB::table('contacts')->whereDate('created_at', today())->count();
        $total_users_today = User::whereDate('created_at', today())->count();

        $total_earnings = Order::where('payment_status', 1)->sum('total');
        $total_users = User::count();
        $total_orders = Order::count();
        $total_contacts = DB::table('contacts')->count();

        return view('back.index', compact('total_earnings_today', 'total_users_today', 'total_orders_today', 'total_contacts_today', 'total_earnings', 'total_users', 'total_orders', 'total_contacts'));
    }
    public function tinymce_upload()
    {
        $imageFolder = "uploads/tinymce/";
        $temp = current($_FILES);
        $filetowrite = $imageFolder . $temp['name'];
        move_uploaded_file($temp['tmp_name'], $filetowrite);
        // Determine the base URL
        echo json_encode(array('location' => asset($filetowrite)));
    }

    public function wallets(){
        $wallets = Order::where('wallet',1)->get();
        return view('back.wallets', compact('wallets'));
    }

}
