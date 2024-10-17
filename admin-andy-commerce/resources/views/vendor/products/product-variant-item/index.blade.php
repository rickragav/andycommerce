@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <!-- Header -->
        <div class="row mr-1">
            <div class="col-12">
                <div class="card tt-page-header">
                    <div class="card-body d-lg-flex align-items-center justify-content-lg-left">
                        <a href="{{ route('vendor.products-variant.index', [Auth::user()->username]) }}"
                            class="btn btn-primary mr-2"><i class="fas fa-chevron-left"></i></a>
                        <h2 class="h5 mb-lg-0">Values - {{ $variant->name }}</h2>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">

                    <div class="row">
                        <div class="col-12">
                            <div class="card" id="section-2">

                                <div class="card-body">
                                    {{ $dataTable->table() }}
                                </div>

                            </div>
                        </div>

                    </div>

                    <form action="{{ route('vendor.products-variant-item.store', [Auth::user()->username]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf

                        <!--variation info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">Add New Variation Value</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">Variation Value Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="Type variation value name" required value="{{ old('name') }}">

                                </div>

                                @if ($variant->id == 2)
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Color Code</label>
                                        <input type="color" name="color_code" id="color_code" class="form-control">
                                    </div>
                                @endif

                                <input type="hidden" name="variant_id" value="{{ $variant->id }}">

                            </div>
                        </div>
                        <!-- variation info end-->

                        <button type="submit" class="btn btn-primary mb-4">Save Value</button>

                    </form>

                </div>
                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">{{ $variant->name }} Information</h5>
                            <!-- Sidebar Links -->
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">

                                    <li>
                                        <a href="#section-1" class="active">All Variantion Values
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#section-2">Add New Variantion Value
                                        </a>
                                    </li>
                                    <!-- Add more sections as needed -->
                                </ul>
                            </div>
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

            // Initialize file manager
            file_manager("lfm", "image", true, {
                prefix: route_prefix
            });

        })

        $(document).ready(function() {
            const changeStatusUrl =
                "{{ route('vendor.products-variant-item.change-status', [Auth::user()->username]) }}"; // Generate URL from Blade

            $('body').on('click', '.change-status', function(event) {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                console.log('id ' + id);

                $.ajax({
                    url: changeStatusUrl, // Use pre-generated URL
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
