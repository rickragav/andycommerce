@if (count($combinations[0]) > 0)


    <div class="card bg-light-subtle border">

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th>
                                <label for="" class="control-label">Variation</label>
                            </th>
                            <th data-breakpoints="xs sm">
                                <label for="" class="control-label">Price</label>
                            </th>
                            <th data-breakpoints="xs sm">
                                <label for="" class="control-label">Stock <code
                                        class="text-warning fw-medium">(Default
                                        Location)</code></label>
                            </th>
                            <th data-breakpoints="xs sm">
                                <label for="" class="control-label">SKU</label>
                            </th>

                        </tr>
                    </thead>
                    @foreach ($combinations as $key => $combination)
                        @php
                            $name = '';
                            $variation_key = '';
                            $lstKey = array_key_last($combination);

                            foreach ($combination as $option_id => $choice_id) {
                                // $option_name = \App\Models\Variation::find($option_id)->collectLocalization('name');
                                // $choice_name = \App\Models\VariationValue::find($choice_id)->collectLocalization('name');

                                $option_name = \AndyCommerce\Core\Models\ProductVariant::find($option_id)->name;
                                $choice_name = \AndyCommerce\Core\Models\ProductVariantItem::find($choice_id)->name;

                                $name .= $choice_name;
                                $variation_key .= $option_id . ':' . $choice_id . '/';

                                if ($lstKey != $option_id) {
                                    $name .= '-';
                                }
                            }
                        @endphp
                        <tr class="variant">
                            <td>
                                <input type="text" value="{{ $name }}" class="form-control" disabled>

                                <input type="hidden" value="{{ $variation_key }}"
                                    name="variations[{{ $key }}][variation_key]">
                            </td>
                            <td>
                                <input type="number" step="0.01" name="variations[{{ $key }}][price]"
                                    value="0" min="0" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" name="variations[{{ $key }}][stock]" value="0"
                                    min="0" class="form-control" required>
                            </td>
                            <td>
                                <input type="text" name="variations[{{ $key }}][sku]"
                                    value="{{ $name }}" class="form-control">
                            </td>


                        </tr>
                    @endforeach

                </table>
            </div>
        </div>

    </div>

@endif
