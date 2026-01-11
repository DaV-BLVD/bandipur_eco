<?php

// app/Http/Controllers/Admin/ImportantInfoController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportantInfo;
use Illuminate\Http\Request;

class ImportantInfoController extends Controller
{
    public function index()
    {
        $infos = ImportantInfo::orderBy('id', 'asc')->get();
        return view('admin.important_infos.index', compact('infos'));
    }

    public function create()
    {
        $info = new ImportantInfo();
        return view('admin.important_infos.form', compact('info'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*' => 'required|string|max:500',
            'status' => 'required|boolean',
        ]);

        ImportantInfo::create($data);

        return redirect()->route('important-infos.index')->with('success', 'Info added successfully.');
    }

    public function edit(ImportantInfo $importantInfo)
    {
        $info = $importantInfo;
        return view('admin.important_infos.form', compact('info'));
    }

    public function update(Request $request, ImportantInfo $importantInfo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*' => 'required|string|max:500',
            'status' => 'required|boolean',
        ]);

        $importantInfo->update($data);

        return redirect()->route('important-infos.index')->with('success', 'Info updated successfully.');
    }

    public function destroy(ImportantInfo $importantInfo)
    {
        $importantInfo->delete();
        return redirect()->route('important-infos.index')->with('success', 'Info deleted successfully.');
    }
}
