<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Story;
use App\Models\Page;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('draft', null)->inRandomOrder()->take(12)->get();
        $categories = Category::orderByDesc('updated_at')->get();
        $articles = Article::orderByDesc('updated_at')->take(3)->get();
        $stories = Story::orderByDesc('id')->get();
        $sliders = Slider::orderByDesc('id')->get();
        return view('front.index', compact('products', 'categories', 'articles', 'stories', 'sliders'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q'); // GET veya POST isteğinden "q" değişkenini alın

        // Arama sorgusunu yapın ve sonuçları döndürün
        $results = Product::where('name', 'like', "%$q%")->get();

        return response()->json($results);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->where('draft', null)->firstorFail();
        return view('front.product_detail', compact('product'));
    }

    public function category($slug, $short = null)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            abort(404);
        }
        switch ($short) {
            case 'discrount':
                $column = 'discount';
                $order = 'desc';
                break;
            case 'price-asc':
                $column = 'price';
                $order = 'asc';
                break;
            case 'price-desc':
                $column = 'price';
                $order = 'desc';
                break;
            case 'best-sellers':
                $column = 'sales_count';
                $order = 'desc';
                break;
            case 'most-viewed':
                $column = 'views_count';
                $order = 'desc';
                break;
            default:
                $column = 'updated_at';
                $order = 'desc';
                break;
        }
        $products = Product::where('draft', null)->where('category_id', $category->id)->orderBy($column, $order)->with('category')->paginate(24);
        $total_products = Product::where('draft', null)->where('category_id', $category->id)->count();
        return view('front.category', compact('category', 'products', 'total_products'));
    }

    public function live_preview($slug, $type)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        if ($type == 'admin_demo') {
            $url = $product->admin_demo_url;
            $button_name = __('Admin Dashboard');
        } else {
            $url = $product->demo_url;
            $button_name = __('Live Preview');
        }
        $product_name = $product->name;
        $product_slug = $product->slug;
        return view('front.partials.live_preview', compact('url', 'button_name', 'product_name', 'product_slug'));
    }


    public function contact()
    {
        return view('front.pages.contact');
    }

    public function contact_send(Request $request)
    {
        recaptchaCheck($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        DB::table('contacts')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', __('Your message has been sent successfully.'));

    }

    public function blog()
    {
        $articles = Article::orderByDesc('updated_at')->paginate(24);
        return view('front.pages.blog', compact('articles'));
    }
    public function article($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('front.pages.article_detail', compact('article'));
    }
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('front.pages.page_detail', compact('page'));
        } else {
            abort(404);
        }
    }

    public function product_view(Request $request)
    {
        $product = Product::where('slug', $request->product_slug)->firstOrFail();
        $product->views_count = $product->views_count + 1;
        $product->save();
    }

    public function sitemap()
    {
        $products = Product::select('id','slug')->where('draft', null)->get();
        $categories = Category::all();
        $articles = Article::select('id','slug');
        $pages = Page::all();
        $view = view('front.partials.sitemap', compact('products', 'categories', 'articles', 'pages'));
        return response($view)->header('Content-Type', 'application/xml');

    }
}
