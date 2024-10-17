<select class="form-control select2" name="option_{{ $variation_id }}_choices[]" multiple
    onchange="generateVariationCombinations()" placeholder="Select variation values">
    @foreach ($variation_values as $key => $variation_value)
        <option value="{{ $variation_value->id }}">{{ $variation_value->name }}</option>
    @endforeach
</select>
