<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhoWeAreContent;
use Illuminate\Http\Request;

class WhoWeAreContentController extends Controller
{
    public function index()
    {
        $contents = WhoWeAreContent::all();
        return view('admin.who-we-are-contents.index', compact('contents'));
    }

    public function create()
    {
        $content = new WhoWeAreContent();
        return view('admin.who-we-are-contents.form', compact('content'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['heading' => 'required', 'description' => 'required']);
        WhoWeAreContent::create($request->all());
        return redirect()->route('who-we-are-contents.index')->with('success', 'Created successfully');
    }

    public function edit(WhoWeAreContent $who_we_are_content)
    {
        $content = $who_we_are_content;
        return view('admin.who-we-are-contents.form', compact('content'));
    }

    public function update(Request $request, WhoWeAreContent $who_we_are_content)
    {
        $who_we_are_content->update($request->all());
        return redirect()->route('who-we-are-contents.index')->with('success', 'Updated successfully');
    }

    public function destroy(WhoWeAreContent $who_we_are_content)
    {
        $who_we_are_content->delete();
        return back();
    }
}
