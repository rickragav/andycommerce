<?php

namespace AndyCommerce\Core\Controllers;

use AndyCommerce\Core\Models\ProductVariant;
use AndyCommerce\Core\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variations = ProductVariant::isActive()->where('shopper_id', Auth::user()->id)->get();

        return view('vendor.products.product-variant', compact('variations'));
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

    # new chosen variation
    public function getNewVariation(Request $request)
    {
        $variations = ProductVariant::query();
        if ($request->has('chosen_variations')) {
            $variations = $variations->where('shopper_id', Auth::user()->id)->whereNotIn('id', $request->chosen_variations)->get();
        } else {
            $variations = $variations->get();
        }
        if (count($variations) > 0) {
            return [
                'count' => count($variations),
                'view' => view('vendor.products.new_variation', compact('variations'))->render(),
            ];
        } else {
            return false;
        }
    }

    # get variation values to add new product
    public function getVariationValues(Request $request)
    {
        $variation_id = $request->variation_id;

        $variation_values = ProductVariantItem::isActive()->where('variation_id', $variation_id)->get();

        return view('vendor.products.new_variation_values', compact('variation_values', 'variation_id'));
    }

    public function generateVariationCombinations(Request $request)
    {
        $variations_and_values = [];

        if ($request->has('chosen_variations')) {
            $chosen_variations = $request->chosen_variations;
            sort($chosen_variations, SORT_NUMERIC);

            foreach ($chosen_variations as $key => $option) {
                $option_name = 'option_' . $option . '_choices';
                $value_ids = [];

                if ($request->has($option_name)) {
                    $variation_option_values = $request[$option_name];
                    sort($variation_option_values, SORT_NUMERIC);

                    foreach ($variation_option_values as $item) {
                        array_push($value_ids, $item);
                    }
                    $variations_and_values[$option] = $value_ids;
                }
            }
        }
        $combinations = [[]];
        foreach ($variations_and_values as $variation => $variation_values) {
            $tempArray = [];
            foreach ($combinations as $combination_item) {
                foreach ($variation_values as $variation_value) {
                    $tempArray[] = $combination_item + [$variation => $variation_value];
                }
            }
            $combinations = $tempArray;
        }

        return view('vendor.products.new_variation_combinations', compact('combinations'))->render();
    }
}
