<?php

// app/Http/Controllers/Admin/ExclusiveSpecialOfferController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExclusiveSpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExclusiveSpecialOfferController extends Controller
{
    public function index()
    {
        $offers = ExclusiveSpecialOffer::orderBy('created_at', 'desc')->get();
        return view('admin.exclusive_special_offer.index', compact('offers'));
    }

    public function create()
    {
        $offer = new ExclusiveSpecialOffer();
        return view('admin.exclusive_special_offer.form', compact('offer'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'discount'    => 'nullable|string|max:50',
            'icon'        => 'nullable|string|max:255',
            'tags'        => 'nullable|array',
            'tags.*'      => 'string|max:50',
            'status'      => 'required|boolean',
        ]);

        ExclusiveSpecialOffer::create($data);
        return redirect()->route('exclusive-special-offer.index')->with('success', 'Offer created!');
    }

    public function edit(ExclusiveSpecialOffer $exclusiveSpecialOffer)
    {
        return view('admin.exclusive_special_offer.form', ['offer' => $exclusiveSpecialOffer]);
    }

    public function update(Request $request, ExclusiveSpecialOffer $exclusiveSpecialOffer)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'discount'    => 'nullable|string|max:50',
            'icon'        => 'nullable|string|max:255',
            'tags'        => 'nullable|array',
            'tags.*'      => 'string|max:50',
            'status'      => 'required|boolean',
        ]);

        $exclusiveSpecialOffer->update($data);
        return redirect()->route('exclusive-special-offer.index')->with('success', 'Offer updated!');
    }

    public function destroy(ExclusiveSpecialOffer $exclusiveSpecialOffer)
    {
        if ($exclusiveSpecialOffer->image) {
            Storage::disk('public')->delete($exclusiveSpecialOffer->image);
        }
        $exclusiveSpecialOffer->delete();
        return redirect()->route('exclusive-special-offer.index')->with('success', 'Offer deleted successfully!');
    }
}
