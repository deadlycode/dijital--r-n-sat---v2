<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderByDesc('updated_at')->get();
        return view('back.page.index', compact('pages'));
    }
    public function create()
    {
        return view('back.page.create');
    }
    public function edit($id)
    {
        $page = Page::where('id', $id)->first();
        if ($page) {
            return view('back.page.edit', compact('page'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:pages',
        ]);
        $page = new Page;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->description = $request->description;
        $page->content = $request->content;
        $page->save();
        return redirect()->route('admin.page')->with('success', __('Added'));
    }
    public function update(Request $request)
    {
        $page = Page::where('id', $request->id)->first();
        if ($page) {
            if($request->slug != $page->slug){
                $request->validate([
                    'slug' => 'required|unique:pages',
                ]);
            }

            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->description = $request->description;
            $page->content = $request->content;
            $page->updated_at = now();
            $page->save();
            return redirect()->route('admin.page')->with('success', __('Updated'));
        } else {
            abort(404);
        }
    }

    public function delete(Request $request)
    {
        $page = Page::where('id', $request->id)->first();
        if ($page) {
            $page->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }

    public function contacts()
    {
        $contacts = DB::table('contacts')->orderByDesc('created_at')->paginate(100);
        return view('back.page.contacts', compact('contacts'));
    }
    public function contacts_delete(Request $request)
    {
        $contact = DB::table('contacts')->where('id', $request->id)->first();
        if ($contact) {
            DB::table('contacts')->where('id', $request->id)->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }
}
