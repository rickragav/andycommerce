@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>

        <div class="mb-3">
            <a href="{{ route('vendor.products-variant.index', [Auth::user()->username, 'product' => $product->id]) }}" class="btn btn-primary">Back</a>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product: {{$variant->name}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('vendor.products-variant-item.create', ['username' => Auth::user()->username, $product->id, $variant->id]) }}"
                                    class="btn btn-primary"> <i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}


    <script>
        $(document).ready(function() {
            const changeStatusUrl = "{{ route('vendor.products-variant-item.change-status',[Auth::user()->username]) }}"; // Generate URL from Blade

            $('body').on('click', '.change-status', function(event) {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                console.log('id ' + id);

                $.ajax({
                    url: changeStatusUrl,  // Use pre-generated URL
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },

                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

@endpush
