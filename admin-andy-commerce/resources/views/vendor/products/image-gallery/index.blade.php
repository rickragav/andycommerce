@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <!-- Header -->
        <div class="row mr-1">
            <div class="col-12">
                <div class="card tt-page-header">
                    <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                        <div class="col d-flex tt-page-title align-items-center">
                            <a href="{{ route('vendor.products.index', [Auth::user()->username]) }}"
                                class="btn btn-primary mr-2"><i class="fas fa-chevron-left"></i></a>
                            <h2 class="h5 mb-lg-0">Product Image Gallery</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">


                    <form action="{{ route('vendor.products-image-gallery.store', [Auth::user()->username]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf

                        <input type="hidden" name="product" value="{{ $product->id }}">

                        <!--product Thumbnail Start-->

                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h6 class="mb-4">Add New Gallery <code>(Multiple Images
                                        Supported! - <code>(592x592)</code> )</code></h6>
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <div class="col d-flex p-0">
                                        <div id="holder">
                                            <!-- Content of meta_holder -->
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-4">

                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">Choose Gallery Images</span>
                                        <!-- choose media -->
                                        <div id="lfm" data-input="image" data-preview="holder"
                                            class="tt-product-thumb mt-3 cursor-pointer">
                                            <div class="no-avatar-gallery rounded-circle ">
                                                <input id="image" class="form-control" type="hidden" name="image"
                                                    placeholder="Image URL ...">
                                                <span><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--product Thumbnail End-->

                        <button type="submit" class="btn btn-primary mb-4">Save Gallery</button>

                        <div class="row">
                            <div class="col-12">
                                <div class="card" id="section-2">
                                    <div class="card-header">
                                        <h4>All {{ $product->name }} Images</h4>
                                        <div class="card-header-action">
                                            <a href="{{ route('vendor.products.create', ['username' => Auth::user()->username]) }}"
                                                class="btn btn-primary"> <i class="fas fa-plus"></i> Create New</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        {{ $dataTable->table() }}
                                    </div>

                                </div>
                            </div>

                        </div>

                    </form>

                </div>
                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar">
                        <div class="card-body">
                            <h5 class="mb-4">Product Information</h5>
                            <!-- Sidebar Links -->
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">

                                    <li>
                                        <a href="#section-1">Add New Gallery
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#section-2" class="active">All Product Gallery
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
    </script>
@endpush
