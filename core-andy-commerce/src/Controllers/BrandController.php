<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\BrandDataTable;
use AndyCommerce\Core\Facades\Brand;
use AndyCommerce\Core\Services\BrandCoreService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $brand)
    {
        return $brand->render('vendor.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $shopper_id)
    {

        
        BrandCoreService::store($request, Auth::user()->id);

        toastr('Created Sucessfully..', 'success');

        return redirect()->route('vendor.brand.index', ['username' => Auth::user()->username]);
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
        $brand = BrandCoreService::edit($id);

        return view('vendor.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {


        BrandCoreService::update( $request, Auth::user()->id, $id );

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.brand.index', [$username]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userrname,string $id)
    {
       $brand = BrandCoreService::findOrFail($id);

       $brand->delete();

       return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }


    public function changeStatus(Request $request)
    {
        $brand = BrandCoreService::findOrFail($request->id);

        $brand->status = $request->status == 'true' ? 1 : 0;

        $brand->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }
}
