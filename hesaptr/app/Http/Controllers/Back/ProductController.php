<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\ProductStock;
use Auth;
use File;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function properties_index()
    {
        $properties = ProductProperty::all();
        return view('back.products.properties', compact('properties'));
    }
    public function properties_store(Request $request)
    {
        $property = new ProductProperty;
        $property->name = $request->name;
        $property->description = $request->description;
        if ($request->img) {
            $path = 'uploads/properties/property_' . time() . '.webp';
            $img = Image::make($request->img)->resize(32, 32)->encode('webp')->save($path);
            $img->destroy();
            $property->img = $path;
        }
        $property->save();
        return redirect()->back()->with('success', __('Added'));
    }
    public function properties_update(Request $request)
    {
        $property = ProductProperty::where('id', $request->id)->first();
        if ($property) {
            $property->name = $request->name;
            $property->description = $request->description;
            if ($request->img) {
                if (File::exists($property->img)) {
                    File::delete($property->img);
                }
                $path = 'uploads/properties/property_' . time() . '.webp';
                $img = Image::make($request->img)->resize(32, 32)->encode('webp')->save($path);
                $img->destroy();
                $property->img = $path;
            }
            $property->save();
            return redirect()->back()->with('success', __('Updated'));
        } else {
            return redirect()->back()->with('error', __('Not Found'));
        }
    }
    public function properties_destroy(Request $request)
    {
        $property = ProductProperty::where('id', $request->id);
        if ($property->first()->img) {
            File::delete($property->first()->img);
        }
        $property->delete();
        return redirect()->back()->with('success', __('Deleted'));
    }

    public function coupons_index()
    {
        $coupons = Coupon::all();
        return view('back.products.coupons', compact('coupons'));
    }
    public function coupons_store(Request $request)
    {
        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->discount = $request->discount;
        $coupon->min_price_limit = $request->min_price_limit;
        $coupon->max_used = $request->max_used;
        $coupon->save();
        return redirect()->back()->with('success', __('Added'));
    }
    public function coupons_destroy(Request $request)
    {
        $coupon = Coupon::where('id', $request->id);
        $coupon->delete();
        return redirect()->back()->with('success', __('Deleted'));
    }

    public function index()
    {
        $products = Product::orderByDesc('updated_at')->with('category:id,name,slug')->paginate(100);
        return view('back.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderByDesc('updated_at')->get();
        $properties = ProductProperty::all();

        return view('back.products.create', compact('categories', 'properties'));
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::orderByDesc('updated_at')->get();
        $all_properties = ProductProperty::all();
        if ($product->properties) {
            $properties = ProductProperty::whereIn('id', explode(',', $product->properties))->get();
        } else {
            $properties = null;
        }
        return view('back.products.edit', compact('product', 'categories', 'all_properties', 'properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'price' => 'required',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        if ($request->old_price) {
            $product->old_price = $request->old_price;
            $product->discount_rate = 100 - ($request->price * 100 / $request->old_price);
        }
        $product->description = $request->description;
        $product->content = $request->content;

        if ($request->properties) {
            $product->properties = implode(',', $request->properties);
        }

        if ($request->img) {
            $path = 'uploads/products/product_' . time() . '.webp';
            $img = Image::make($request->img)->encode('webp')->save($path);
            $product->img = $path;
        }

        if ($request->sliders) {
            $sliders = [];
            foreach ($request->sliders as $item) {
                $path = 'uploads/products/sliders/slider_' . time() . '.webp';
                $slider = Image::make($item)->encode('webp')->save($path);
                array_push($sliders, $path);
            }
            $product->sliders = json_encode($sliders);
        }

        if ($request->discount_piece && $request->discount_rate) {
            $product->discount_more = $request->discount_piece . ':' . $request->discount_rate;
        }

        if ($request->whatsapp) {
            $product->whatsapp = $request->whatsapp;
        }

        if ($request->buy_button == 1) {
            $product->buy_button = 1;
        } else {
            $product->buy_button = null;
        }

        if ($request->file) {
            $path = 'uploads/files/product_#' . time() . '.' . $request->file->getClientOriginalExtension();
            move_uploaded_file($request->file, $path);
            $product->file = $path;
        }

        if($request->file_url){
            $product->file_url = $request->file_url;
        }


        $product->demo_url = $request->demo_url;
        $product->admin_demo_url = $request->admin_demo_url;

        if ($request->even_if_out_of_stock == 1) {
            $product->even_if_out_of_stock = 1;
        } else {
            $product->even_if_out_of_stock = null;
        }

        if ($request->customer_inputs) {
            $product->customer_inputs = implode('::', $request->customer_inputs);
        }
        if ($request->questions && $request->answers) {
            $faqs = array_zip_combine(['question', 'answer'], $request->questions, $request->answers);
            $product->faqs = json_encode($faqs, JSON_PRETTY_PRINT);
        }
        if($request->draft == 1){
            $product->draft = 1;
        }else{
            $product->draft = null;
        }

        $product->save();

        if ($request->stocks) {
            $data = [];
            foreach (preg_split('/\r\n|[\r\n]/', $request->stocks) as $stock) {
                if ($stock != '') {
                    $item = [
                        'product_id' => $product->id,
                        'content' => $stock,
                        'user_id' => Auth::id(),
                    ];
                    array_push($data, $item);
                }
            }
            $insert = ProductStock::insert($data);
        }

        return redirect()->route('admin.products.index')->with('success', __('Added'));

    }
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ]);
        if ($request->new_product == 1) {
            $product = new Product();
            $message = __('Added');
        } else {
            $product = Product::where('id', $request->id)->first();
            $message = __('Updated');
        }
        if ($product) {
            if ($request->slug != $product->slug) {
                $request->validate([
                    'slug' => 'required|unique:products',
                ]);
            }

            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            if ($request->old_price) {
                $product->old_price = $request->old_price;
                $product->discount_rate = 100 - ($request->price * 100 / $request->old_price);
            } else {
                $product->old_price = null;
                $product->discount_rate = null;
            }

            $product->description = $request->description;

            $product->content = $request->content;

            if ($request->properties) {
                $product->properties = implode(',', $request->properties);
            }

            if ($request->img) {
                if ($product->img) {
                    File::delete($product->img);
                }
                $path = 'uploads/products/product_' . time() . '.webp';
                $img = Image::make($request->img)->encode('webp')->save($path);
                $product->img = $path;
            }

            if ($request->sliders) {
                if ($product->sliders) {
                    foreach (json_decode($product->sliders, true) as $slider) {
                        File::delete($slider);
                    }
                }
                $sliders = [];
                foreach ($request->sliders as $item) {
                    $path = 'uploads/products/sliders/slider_' . time() . '.webp';
                    $slider = Image::make($item)->encode('webp')->save($path);
                    array_push($sliders, $path);
                }
                $product->sliders = json_encode($sliders);
            }

            if ($request->discount_piece && $request->discount_rate) {
                $product->discount_more = $request->discount_piece . ':' . $request->discount_rate;
            } else {
                $product->discount_more = null;
            }

            if ($request->whatsapp) {
                $product->whatsapp = $request->whatsapp;
            } else {
                $product->whatsapp = null;
            }

            if ($request->buy_button == 1) {
                $product->buy_button = 1;
            } else {
                $product->buy_button = null;
            }

            if ($request->file) {
                if ($product->file) {
                    File::delete($product->file);
                }
                $path = 'uploads/files/product_#' . time() . $request->file->getClientOriginalName();
                move_uploaded_file($request->file, $path);
                $product->file = $path;
            }
            if($request->delete_file == 1){
                File::delete($product->file);
                $product->file = null;
            }
            if($request->file_url){
                $product->file_url = $request->file_url;
            }

            $product->demo_url = $request->demo_url;
            $product->admin_demo_url = $request->admin_demo_url;

            if ($request->even_if_out_of_stock == 1) {
                $product->even_if_out_of_stock = 1;
            } else {
                $product->even_if_out_of_stock = null;
            }

            if ($request->customer_inputs) {
                $product->customer_inputs = implode('::', $request->customer_inputs);
            }else{
                $product->customer_inputs = null;
            }

            if ($request->questions && $request->answers) {
                $faqs = array_zip_combine(['question', 'answer'], $request->questions, $request->answers);
                $product->faqs = json_encode($faqs, JSON_PRETTY_PRINT);
            }else{
                $product->faqs = null;
            }
            if($request->draft == 1){
                $product->draft = 1;
            }else{
                $product->draft = null;
            }

            $product->updated_at = now();
            $product->save();

            if ($request->stocks) {
                ProductStock::where('product_id', $product->id)->delete();
                $data = [];
                foreach (preg_split('/\r\n|[\r\n]/', $request->stocks) as $stock) {
                    if ($stock != '') {
                        $item = [
                            'product_id' => $product->id,
                            'content' => $stock,
                            'user_id' => Auth::id(),
                        ];
                        array_push($data, $item);
                    }
                }
                $insert = ProductStock::insert($data);
            } else {
                ProductStock::where('product_id', $product->id)->delete();
            }

            return redirect()->route('admin.products.index')->with('success', $message);
        } else {
            return redirect()->route('admin.products.index')->with('error', __('Not found'));
        }

    }

    public function delete(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product) {
            File::delete($product->img);
            File::delete($product->file);
            File::delete(json_decode($product->sliders, true));
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', __('Deleted'));
        } else {
            return redirect()->route('admin.products.index')->with('error', __('Not found'));
        }
    }

    public function delete_file(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if ($product) {
            File::delete($product->file);
            $product->file = null;
            $product->save();
            return redirect()-back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }

}
