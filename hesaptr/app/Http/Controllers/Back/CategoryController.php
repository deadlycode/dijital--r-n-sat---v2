<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductButton;
use App\Models\ProductOption;
use App\Models\ProductStock;
use File;
use Illuminate\Http\Request;
use Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('updated_at')->get();
        return view('back.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        if ($request->img) {
            $path = 'uploads/categories/cat_' . time() . '.webp';
            $img = Image::make($request->img)->resize(100, 100)->encode('webp')->save($path);
            $img->destroy();
            $category->img = $path;
        }
        $category->save();
        return redirect()->back()->with('success', __('Added'));
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        if ($category) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->description = $request->description;
            if ($request->img) {
                File::delete($category->img);
                $path = 'uploads/categories/cat_' . time() . '.webp';
                $img = Image::make($request->img)->resize(100, 100)->encode('webp')->save($path);
                $img->destroy();
                $category->img = $path;
            }
            $category->updated_at = now();
            $category->save();
            return redirect()->back()->with('success', __('Updated'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }

    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        if ($category) {
            $products = Product::where('category_id', $category->id)->get();
            foreach ($products as $product) {
                ProductStock::where('product_id', $product->id)->delete();
                File::delete($product->img);
                $product->delete();
            }
            File::delete($category->img);
            $category->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }
}
