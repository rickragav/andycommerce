<script>
    "use strict";



    // swith markup based on selection
    function isVariantProduct(el) {



        $(".hasVariation").hide();
        $(".noVariation").hide();

        if ($(el).val() === '1') {
            $(".hasVariation").show();

            // remove required field for non variations
            $("#price").removeAttr('required', true);
            $("#qty").removeAttr('required', true);
            $("#sku").removeAttr('required', true);


        } else {
            $(".noVariation").show();

            // add required field for non variations
            $("#price").attr('required', true);
            $("#qty").attr('required', true);
            $("#sku").attr('required', true);

        }
    }

    // add another variation
    function addAnotherVariation() {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: $('#product-variation-form').serialize(),
            url: "{{ route('vendor.product-variant.newVariation', [Auth::user()->username]) }}",
            success: function(data) {
                if (data.count > 0) {
                    $('.chosen_variation_options').find('.variation-names').find('.select2').siblings(
                        '.dropdown-toggle').addClass("disabled");
                    $('.chosen_variation_options').append(data.view);
                    $('.select2').select2();
                    initFeather();
                }
            }
        });
    }

    // get values for selected variations
    function getVariationValues(e) {

        const getVariationUrl =
            "{{ route('vendor.product-variant.getVariationValues', [Auth::user()->username]) }}";

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: "POST",
            data: {
                variation_id: $(e).val()
            },
            url: getVariationUrl,
            success: function(data) {
                $(e).closest('.row').find('.variationvalues').html(data);
                $('.select2').select2();
            }
        });
    }


    // variation combinations
    function generateVariationCombinations() {

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '{{ route('vendor.product-variant.generateVariationCombinations', [Auth::user()->username]) }}',
            data: $('#product-variation-form').serialize(),
            success: function(data) {
                $('#variation_combination').html(data);

                $('.table').footable();
                initFeather();
                setTimeout(() => {
                    $('.select2').select2();
                }, 300);
            }
        });
    }
</script>
