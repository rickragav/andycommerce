<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\SliderDataTable;
use AndyCommerce\Core\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('vendor.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {

        
       
        $request->validate([
            'banner' => ['required', 'url', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required', 'max:200'],
            'subtitle' => ['max:200'],
            'description' => ['required', 'max:500'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $slider = new Slider();

        // Handle file upload

        // $imagePath = $this->uploadImageShopperStorage($request, 'banner', ShopperSubFolder::SLIDER);
        $slider->banner = $request->banner;

        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->shopper_id = Auth::user()->id;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        toastr('Create Successfully!', 'success');

        return redirect()->route('vendor.slider.index', ['username' => Auth::user()->username]);
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
    public function edit(string $username,string $id)
    {
        $slider = Slider::findorFail($id);
        return view('vendor.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $username, string $id)
    {
        $request->validate([
            'banner' => ['nullable', 'url', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required', 'max:200'],
            'subtitle' => ['max:200'],
            'description' => ['required', 'max:500'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $slider = Slider::findOrFail($id);

        // Handle file upload

        //$imagePath = $this->updateImageShopperStorage($request, 'banner', ShopperSubFolder::SLIDER, $slider->banner);

        $slider->banner = empty(!$request->banner) ? $request->banner : $slider->banner;

        $slider->shopper_id = Auth::user()->id;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.slider.index',['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userrname,string $id)
    {
        $slider = Slider::findOrFail($id);

        $slider->delete();

        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }
}
