<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\SubCategoryDataTable;
use AndyCommerce\Core\Models\Category;
use AndyCommerce\Core\Models\ChildCategory;
use AndyCommerce\Core\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('vendor.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('shopper_id', Auth::user()->id)->get();
        return view('vendor.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],

            'name' => [
                'required',
                'max:200',
                // Add unique validation where name is unique for the vendor_id
                Rule::unique('sub_categories')->where(function ($query) {
                    return $query->where('shopper_id', Auth::user()->id);
                }),
            ],
            'status' => ['required'],
        ]);

        $subCategory = new SubCategory();
        $subCategory->shopper_id = Auth::user()->id;
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        toastr()->success('Created Sucessfully!','success');



        return redirect()->route('vendor.sub-category.index',['username' => Auth::user()->username]);
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
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('vendor.sub-category.edit', compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $username, string $id)
    {
        $request->validate([
            'category' => ['required'],

            Rule::unique('sub_categories')
                ->where(function ($query) {
                    return $query->where('shopper_id', Auth::user()->id);
                })
                ->ignore($id),
            'status' => ['required'],
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->shopper_id = Auth::user()->id;
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        toastr()->success('Updated Sucessfully!','success');

        return redirect()->route('vendor.sub-category.index',['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username,string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $childCategory = ChildCategory::where('sub_category_id', $subCategory->id)->count();

        if ($childCategory > 0) {
            return response(['status' => 'error', 'message' => 'This items contains childitems for delete this you have to delete the child items first!']);
        }

        $subCategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }

    public function changeStatus(Request $request){

        $subCategory = SubCategory::findOrFail($request->id);

        $subCategory->status = $request->status == 'true' ? 1:0;

        $subCategory->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }
}
