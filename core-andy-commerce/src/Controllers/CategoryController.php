<?php

namespace AndyCommerce\Core\Controllers;


use App\Http\Controllers\Controller;
use AndyCommerce\Core\CategoryCoreService;
use AndyCommerce\Core\DataTables\CategoryDataTable;
use AndyCommerce\Core\Models\Category;
use AndyCommerce\Core\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)

    {
        return $dataTable->render('vendor.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CategoryCoreService::store($request, Auth::user()->id);

        toastr('Created Sucessfully..', 'success');

        return redirect()->route('vendor.category.index', ['username' => Auth::user()->username]);
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
        $category = Category::findOrFail($id);
        return view('vendor.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username, string $id)
    {
        CategoryCoreService::update($request, $username, Auth::user()->id, $id);

        toastr('Updated Sucessfully..', 'success');

        return redirect()->route('vendor.category.index', ['username' => Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username, string $id)
    {
        $category = CategoryCoreService::findOrFail($id);

        $subCategory = SubCategory::where('category_id', $category->id)->count();

        if ($subCategory > 0) {
            return response(['status' => 'error', 'message' => 'This items contains subitems for delete this you have to delete the sub items first!']);
        }

        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Succuessfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = CategoryCoreService::findOrFail($request->id);

        $category->status = $request->status == 'true' ? 1 : 0;

        $category->save();

        return response(['status' => 'success', 'message' => 'Status has been updated Succuessfully!']);
    }

}
