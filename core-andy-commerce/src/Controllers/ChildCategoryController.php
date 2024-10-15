<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\DataTables\ChildCategoryDataTable;
use AndyCommerce\Core\Models\Category;
use AndyCommerce\Core\Models\ChildCategory;
use AndyCommerce\Core\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('vendor.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('shopper_id', Auth::user()->id)->get();
        return view('vendor.child-category.create', compact('categories'));
    }

    /**
     * Get Sub Categories
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)
            ->where('shopper_id', Auth::user()->id)
            ->where('status', 1)
            ->get();
        return $subCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],

            'name' => [
                'required',
                'max:200',
                // Add unique validation where name is unique for the vendor_id
                Rule::unique('child_categories')->where(function ($query) {
                    return $query->where('shopper_id', Auth::user()->id);
                }),
            ],
            'status' => ['required'],
        ]);

        $childCategory = new ChildCategory();
        $childCategory->shopper_id = Auth::user()->id;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr()->success('Created Sucessfully!', 'success');

        return redirect()->route('vendor.child-category.index', ['username' => Auth::user()->username]);
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
    public function edit(string $username, string $id)
    {
        $categories = Category::all();

        $childCategory = ChildCategory::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $childCategory->category_id)->get();
        return view('vendor.child-category.edit', compact('categories', 'childCategory', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            Rule::unique('child_categories')
                ->where(function ($query) {
                    return $query->where('shopper_id', Auth::user()->id);
                })
                ->ignore($id),
            'status' => ['required'],
        ]);

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->shopper_id = Auth::user()->id;
        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr()->success('Updated Sucessfully!', 'success');

        return redirect()->route('vendor.child-category.index', ['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username, string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);

        $childCategory->status = $request->status == 'true' ? 1 : 0;

        $childCategory->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }
}
