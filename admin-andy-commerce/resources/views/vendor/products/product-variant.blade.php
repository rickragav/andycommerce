@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <!-- Header -->
        <div class="row mr-1">
            <div class="col-12">
                <div class="card tt-page-header">
                    <div class="card-body d-lg-flex align-items-center justify-content-lg-left">
                        <a href="{{ route('vendor.products.index', [Auth::user()->username]) }}"
                            class="btn btn-primary mr-2"><i class="fas fa-chevron-left"></i></a>
                        <h2 class="h5 mb-lg-0">Variation</h2>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">



                    <form id="product-variation-form" action="{{ route('vendor.products-variant.update', [Auth::user()->username, 1]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf


                        <!--variation info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">Basic Information</h5>

                                @if (count($variations) > 0)
                                    <div class="row g-3 mt-1">
                                        <div class="col-lg-6">
                                            <div class="mb-0">
                                                <label class="form-label">Select Variations</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-0">
                                                <label class="form-label">Select Values</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chosen_variation_options">
                                        <div class="row g-3">
                                            <div class="col-lg-6">
                                                <div class="mb-0">
                                                    <select class="form-control select2" onchange="getVariationValues(this)"
                                                        name="chosen_variations[]">
                                                        <option value="">Select a Variation
                                                        </option>
                                                        @foreach ($variations as $key => $variation)
                                                            <option value="{{ $variation->id }}">
                                                                {{ $variation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-0">
                                                    <div class="variationvalues">
                                                        <input type="text" class="form-control"
                                                            placeholder="Select variation values" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- variation info end-->

                        <button type="submit" class="btn btn-primary mb-4">Save Changes</button>

                    </form>

                </div>
                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">Variation Information</h5>
                            <!-- Sidebar Links -->
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">


                                    <li>
                                        <a href="#section-1" class="active">Add New Variant
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

@section('scripts')
    @include('backend.inc.product-scripts')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Initialize file manager
            file_manager("lfm", "image", true, {
                prefix: route_prefix
            });

        })
    </script>
@endpush
