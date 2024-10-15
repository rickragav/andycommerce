<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view();
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login()
    {
        if (auth()->check()) {
            $user = auth()->user();

            return redirect()->route('vendor.dashboard', ['username' => $user->username]);
        }

        return view('vendor.auth.login');
    }

    public function dashboard($username)
    {
        $user = auth()->user();

        //Ensure that the username in the URL matches the authenticated user's username
        if ($user->username !== $username) {
            abort(403, 'Unauthorized access');
        }

        return view('vendor.dashboard', compact('username'));
    }
}
