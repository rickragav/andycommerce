<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\Enums\VendorProfileUpdate;
use AndyCommerce\Core\Models\Shopper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProfileController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Shopper::where('shopper_id', Auth::user()->id)->first();
        return view('vendor.profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $operation, string $id)
    {
        if ((VendorProfileUpdate::UPDATE_ADDITIONAL_DETAIL)->value === $operation) {
            $request->validate([
                'banner' => ['nullable', 'url', 'max:3000'],
                'address' => ['required'],
                'description' => ['required'],
                // 'email'=>['required','email','max:200'],
                // 'phone'=> ['required','max:50'],
                //'fb_link'=> ['nullable','url'],
            ]);
        } else if ((VendorProfileUpdate::UPDATE_SOCIAL_LINK)->value === $operation) {
            $request->validate([
                'fb_link' => ['nullable', 'url'],
                'tw_link' => ['nullable', 'url'],
                'insta_link' => ['nullable', 'url'],
            ]);
        }else if ((VendorProfileUpdate::UPDATE_PROFILE)->value === $operation) {
            $request->validate([
                'phone'=> ['required','max:50'],
            ]);
        }

        $shopper = Shopper::findOrfail($id);

        // Handle file upload

        $bannerPath = $request->banner;

        $shopper->banner = empty(!$bannerPath) ? $bannerPath : $shopper->banner;
        $shopper->address = $request->address ? $request->address: $shopper->address;
        $shopper->phone = $request->phone ? $request->phone: $shopper->phone;
        $shopper->description = $request->description ?  $request->description: $shopper->description;
        $shopper->fb_link = $request->fb_link ?  $request->fb_link: $shopper->fb_link;
        $shopper->tw_link = $request->tw_link ?  $request->tw_link: $shopper->tw_link;
        $shopper->insta_link = $request->insta_link ?  $request->insta_link: $shopper->insta_link;
        $shopper->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
