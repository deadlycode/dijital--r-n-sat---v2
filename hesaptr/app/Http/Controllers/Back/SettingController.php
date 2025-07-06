<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Story;
use App\Models\Slider;
use Cache;
use DB;
use Image;
use File;

class SettingController extends Controller
{
    public function index()
    {
        $robots_txt = file_get_contents('robots.txt');
        $pages = Page::all();
        return view('back.settings.general', compact('robots_txt', 'pages'));
    }
    public function update(Request $request)
    {
        if ($request->settings_name == 'popup') {
            Cache::forever('popup_active', $request->popup_active);
            Cache::forever('popup_title', $request->popup_title);
            Cache::forever('popup_content', $request->popup_content);
            if ($request->popup_button_name) {
                Cache::forever('popup_button_name', $request->popup_button_name);
                Cache::forever('popup_button_link', $request->popup_button_link);
            }
            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'google') {
            Cache::forever('google_recaptcha_sitekey', $request->google_recaptcha_sitekey);
            Cache::forever('google_recaptcha_secretkey', $request->google_recaptcha_secretkey);

            Cache::forever('google_oauth_client_id', $request->google_oauth_client_id);
            Cache::forever('google_oauth_client_secret', $request->google_oauth_client_secret);
            Cache::forever('google_oauth_redirect', route('login.google.callback'));
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->settings_name == 'homepage') {
            Cache::forever('homepage_meta_title', $request->homepage_meta_title);
            Cache::forever('homepage_meta_description', $request->homepage_meta_description);
            Cache::forever('homepage_meta_keywords', $request->homepage_meta_keywords);
            Cache::forever('homepage_slogan', $request->homepage_slogan);
            Cache::forever('homepage_sub_slogan', $request->homepage_sub_slogan);
            Cache::forever('homepage_step_1', $request->homepage_step_1);
            Cache::forever('homepage_step_2', $request->homepage_step_2);
            Cache::forever('homepage_step_3', $request->homepage_step_3);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->settings_name == 'smtp') {
            Cache::forever('smtp_host', $request->smtp_host);
            Cache::forever('smtp_port', $request->smtp_port);
            Cache::forever('smtp_username', $request->smtp_username);
            Cache::forever('smtp_password', $request->smtp_password);
            Cache::forever('smtp_encryption', $request->smtp_encryption);
            Cache::forever('smtp_from_address', $request->smtp_from_address);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->settings_name == 'logo_favicon') {
            if ($request->logo_img) {
                $path = 'uploads/logo.webp';
                $img = Image::make($request->logo_img)->encode('webp')->save($path);
                Cache::forever('logo_img', $path);
            }
            if ($request->favicon_img) {
                $path = 'uploads/favicon.ico';
                copy($request->favicon_img, $path);
                Cache::forever('favicon_img', $path);
            }
            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'social_media') {
            Cache::forever('wp', $request->wp);
            Cache::forever('fb', $request->fb);
            Cache::forever('sk', $request->sk);
            Cache::forever('yt', $request->yt);
            Cache::forever('ig', $request->ig);
            Cache::forever('tw', $request->tw);
            Cache::forever('pin', $request->pin);
            Cache::forever('in', $request->in);
            Cache::forever('git', $request->git);
            Cache::forever('tg', $request->tg);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->settings_name == 'contact') {
            Cache::forever('contact_address', $request->contact_address);
            Cache::forever('contact_phone', $request->contact_phone);
            Cache::forever('contact_email', $request->contact_email);
            Cache::forever('contact_meta_title', $request->contact_meta_title);
            Cache::forever('contact_meta_description', $request->contact_meta_description);
            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'site') {
            Cache::forever('site_name', $request->site_name);
            Cache::forever('site_locale', $request->site_locale);
            switch ($request->currency) {
                case 'USD':
                    Cache::forever('currency_symbol', '$');
                    break;
                case 'TRY':
                    Cache::forever('currency_symbol', '₺');
                    break;
                case 'EUR':
                    Cache::forever('currency_symbol', '€');
                    break;
                case 'GBP':
                    Cache::forever('currency_symbol', '£');
                    break;
            }
            Cache::forever('currency', $request->currency);

            Cache::forever('language', $request->language);
            Cache::forever('yandex_translate_active', $request->yandex_translate_active);
            Cache::forever('product_columns_count', $request->product_columns_count);
            Cache::forever('checkout_message', $request->checkout_message);
            Cache::forever('agree_message', $request->agree_message);

            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'footer_links') {
            if ($request->footer_links_text && $request->footer_links_url) {
                $footer_links = array_zip_combine(['text', 'url'], $request->footer_links_text, $request->footer_links_url);
                Cache::forever('footer_links', $footer_links);
            } else {
                Cache::forever('footer_links', null);
            }
            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'robots_txt') {
            $path = public_path('robots.txt');
            file_put_contents($path, $request->robots_txt);
            return redirect()->back()->with('success', __('Updated'));
        }
        if ($request->settings_name == 'extra_code') {
            Cache::forever('extra_header', $request->extra_header);
            Cache::forever('extra_footer', $request->extra_footer);
            return redirect()->back()->with('success', __('Updated'));
        }

        if ($request->settings_name == 'telegram_bot') {
            Cache::forever('telegram_bot_active', $request->telegram_bot_active);
            Cache::forever('telegram_bot_token', $request->telegram_bot_token);
            Cache::forever('telegram_bot_chat_id', $request->telegram_bot_chat_id);
            return redirect()->back()->with('success', __('Updated'));
        }

    }

    public function stories()
    {
        $stories = Story::all();
        return view('back.settings.stories', compact('stories'));
    }
    public function stories_store(Request $request)
    {
        $story = new Story();
        $story->name = $request->name;
        if ($request->img) {
            $path = 'uploads/stories/'. time() . '.webp';
            $img = Image::make($request->img)->encode('webp')->save($path);
            $story->img = $path;
        }
        $story->url = $request->url;
        $story->save();

        return redirect()->route('admin.settings.stories')->with('success', __('Added'));
    }
    public function stories_delete(Request $request)
    {
        $story = Story::where('id', $request->id)->first();
        if ($story) {
            File::delete($story->img);
            $story->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Error'));
        }
    }

    public function sliders()
    {
        $sliders = Slider::all();
        return view('back.settings.sliders', compact('sliders'));
    }
    public function sliders_store(Request $request)
    {
        $slider = new Slider;
        if ($request->img) {
            $path = 'uploads/sliders/'. time() . '.webp';
            $img = Image::make($request->img)->encode('webp')->save($path);
            $slider->img = $path;
        }
        $slider->url = $request->url;
        $slider->save();

        return redirect()->route('admin.settings.sliders')->with('success', __('Added'));
    }
    public function sliders_delete(Request $request)
    {
        $slider = Slider::where('id', $request->id)->first();
        if ($slider) {
            File::delete($slider->img);
            $slider->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Error'));
        }
    }



    public function footer_menu()
    {
        $footer_menu = DB::table('footer_menus')->get();
        return view('back.settings.footer_menu', compact('footer_menu'));
    }

    public function footer_menu_add()
    {
        return view('back.settings.add_footer_menu');
    }
    public function footer_menu_store(Request $request)
    {
        DB::table('footer_menus')->insert([
            'column' => $request->column,
            'name' => $request->name,
            'url' => $request->url,
        ]);
        return redirect()->route('admin.settings.footer_menu')->with('success', __('Added'));
    }
    public function footer_menu_delete(Request $request)
    {
        $footer_menu = DB::table('footer_menus')->where('id', $request->footer_menu_id);
        if ($footer_menu) {
            $footer_menu->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Error'));
        }
    }

    public function footer_menu_column_update(Request $request)
    {
        Cache::forever('footer_menu_column1', $request->footer_menu_column1);
        Cache::forever('footer_menu_column2', $request->footer_menu_column2);
        Cache::forever('footer_menu_column3', $request->footer_menu_column3);
        return redirect()->back()->with('success', __('Updated'));
    }

    public function telegram_test()
    {
        telegram_bot_send_message('Test Notification');
        return redirect()->back()->with('success', __('Test Notification'));
    }
}
