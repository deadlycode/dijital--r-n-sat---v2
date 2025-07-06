<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function payment_method()
    {
        return view('back.module.payment_method');
    }
    public function payment_method_update(Request $request)
    {
        if ($request->module_name == 'paytr') {
            Cache::forever('paytr_active', $request->paytr_active);
            Cache::forever('paytr_merchant_id', $request->paytr_merchant_id);
            Cache::forever('paytr_merchant_key', $request->paytr_merchant_key);
            Cache::forever('paytr_merchant_salt', $request->paytr_merchant_salt);

            Cache::forever('paytr_name', $request->paytr_name);
            if($request->convert_to_exchange_rate_paytr == 1){
                Cache::forever('convert_to_exchange_rate_paytr', $request->convert_to_exchange_rate_paytr);
                Cache::forever('to_exchange_paytr', $request->to_exchange_paytr);
            }else{
                Cache::forever('convert_to_exchange_rate_paytr', null);
                Cache::forever('to_exchange_paytr', null);
            }
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->module_name == 'stripe') {
            Cache::forever('stripe_active', $request->stripe_active);
            Cache::forever('stripe_api_key', $request->stripe_api_key);
            Cache::forever('stripe_api_secret', $request->stripe_api_secret);
            Cache::forever('stripe_name', $request->stripe_name);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->module_name == 'shopier') {
            Cache::forever('shopier_active', $request->shopier_active);
            Cache::forever('shopier_api_username', $request->shopier_api_username);
            Cache::forever('shopier_api_secret', $request->shopier_api_secret);
            Cache::forever('shopier_name', $request->shopier_name);
            if($request->convert_to_exchange_rate_shopier == 1){
                Cache::forever('convert_to_exchange_rate_shopier', $request->convert_to_exchange_rate_shopier);
                Cache::forever('to_exchange_shopier', $request->to_exchange_shopier);
            }else{
                Cache::forever('convert_to_exchange_rate_shopier', null);
                Cache::forever('to_exchange_shopier', null);
            }
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->module_name == 'papara') {
            Cache::forever('papara_active', $request->papara_active);
            Cache::forever('papara_account_number', $request->papara_account_number);
            Cache::forever('papara_name', $request->papara_name);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->module_name == 'iban') {
            Cache::forever('iban_name', $request->iban_name);
            if ($request->ibans && $request->iban_banks && $request->iban_names) {
                Cache::forever('iban_active', $request->iban_active);

                $ibans = array_zip_combine(['iban', 'iban_bank', 'iban_name'], $request->ibans, $request->iban_banks, $request->iban_names);
                Cache::forever('ibans', $ibans);
            } else {
                Cache::forever('ibans', null);
            }
            return redirect()->back()->with('success', __('Banka Hesapları Güncellendi'));
        }
    }
}
