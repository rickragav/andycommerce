@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section ">

        <!-- Header -->
        <div class="row mr-1">
            <div class="col-12">
                <div class="card tt-page-header">
                    <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                        <div class="tt-page-title">
                            <h2 class="h5 mb-lg-0">Add Product</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form id="product-variation-form"
                        action="{{ route('vendor.products.store', ['username' => Auth::user()->username]) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">Basic Information</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input class="form-control" type="text" id="name" value="{{ old('name') }}"
                                        placeholder="Type your product name" name="name">
                                    <span class="fs-sm text-muted">
                                        Product name is required and recommended to be unique.
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" id="short_description" placeholder="Type your product short description" rows="5"
                                        name="short_description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="long_description" class="form-control summernote"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--basic information end-->

                        <!--product Thumbnail Start-->

                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4">Images</h5>
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
                                    <label class="form-label">Thumbnail (592x592)</label>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">Choose Product Thumbnail</span>
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

                        <!--product Youtube Vedio Start-->

                        <div class="mb-4 card" id="section-3">
                            <div class="card-body">
                                <label for="name" class="form-label">Product Vedio Embeded Link</label>
                                <input class="form-control" type="text" id="vedio_link" name="vedio_link">
                            </div>

                        </div>

                        <!--product Youtube Vedio End-->


                        <!--product Catelog Start-->

                        <div class="mb-4 card" id="section-4">
                            <div class="card-body">
                                <h5 class="mb-4">Product Categories</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Category</label>
                                        <select id="inputState" class="form-control main-category" name="category">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Sub Category</label>
                                        <select id="inputState" class="form-control sub-category" name="sub_category">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Child Category</label>
                                        <select id="inputState" class="form-control child-category" name="child_category">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--product Catelog Start-->

                        <!--product Brand Start-->

                        <div class="mb-4 card" id="section-5">
                            <div class="card-body">
                                <h5 class="mb-4">Product Brand</h5>

                                <select id="inputState" class="form-control" name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!--product Brand End-->


                        <!--product price sku and stock start-->
                        <div class="card mb-4" id="section-6">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-4">Price, Sku & Stock</h5>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label fw-medium text-primary" for="is_variant">Has
                                            Variations?</label>
                                        <select id="is_variant" class="form-control" onchange="isVariantProduct(this)"
                                            name="is_variant">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- without variation start-->
                                <div class="noVariation">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <label class="form-label">Price <span class="text-danger">*</span></label>
                                            <input id="price" type="text" name="price" class="form-control"
                                                placeholder="Product price" value="{{ old('price') }}">

                                        </div>

                                        <div class="col-md-4">

                                            <label class="form-label">Stock<span class="text-danger">*</span></label>
                                            <input id="qty" type="number" min="0" name="qty"
                                                class="form-control" placeholder="Stock qty" value="{{ old('qty') }}">

                                        </div>

                                        <div class="col-md-4">

                                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                                            <input id="sku" type="text" name="sku" class="form-control"
                                                placeholder="Product Sku" value="{{ old('sku') }}">

                                        </div>

                                    </div>
                                </div>
                                <!-- without variation End-->
                                <!--for variation row start-->
                                <div class="hasVariation" style="display: none">

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

                                                        <select class="form-control selectric"
                                                            onchange="getVariationValues(this)"
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

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-4 mt-4">
                                                    <button class="btn btn-primary" type="button"
                                                        onclick="addAnotherVariation()">
                                                        <i data-feather="plus" class="me-1"></i>
                                                        Add Another Variation
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="variation_combination" id="variation_combination">
                                        {{-- combinations will be added here via ajax response --}}
                                    </div>






                                </div>
                                <!--for variation row end-->
                            </div>
                        </div>
                        <!--product price sku and stock End-->

                        <!--product discount start-->
                        <div class="card mb-4" id="section-7">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-4">Product Discount</h5>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Start Date</label>
                                        <input type="text" name="offer_start_date" class="form-control datepicker"
                                            value="{{ old('offer_start_date') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">End Date</label>
                                        <input type="text" name="offer_end_date" class="form-control datepicker"
                                            value="{{ old('offer_end_date') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Discount Amount</label>
                                        <input type="text" name="offer_price" class="form-control"
                                            value="{{ old('offer_price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--product discount start-->

                        <!--product Feature Type start-->
                        <div class="mb-4 card" id="section-8">
                            <div class="card-body">
                                <h5 class="mb-4">Product Feature Type</h5>

                                <select id="inputState" class="form-control" name="product_feature_type">
                                    <option value="">Select</option>
                                    <option value="new_arrival">New Arrival</option>
                                    <option value="featured_product">Featured</option>
                                    <option value="top_product">Top Product</option>
                                    <option value="best_product">Best Product</option>
                                </select>
                            </div>
                        </div>
                        <!--product Feature Type End-->

                        <!--product Status start-->
                        <div class="mb-4 card" id="section-9">
                            <div class="card-body">
                                <h5 class="mb-4">Product Status</h5>

                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                            </div>
                        </div>
                        <!--product Status start-->


                        <!--seo meta description start-->
                        <div class="card mb-4" id="section-10">
                            <div class="card-body">
                                <h5 class="mb-4">SEO Meta Configuration</h5>

                                <div class="mb-4">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        placeholder="Type meta title" class="form-control">
                                    <span class="fs-sm text-muted">
                                        Set a meta tag title. Recommended to be simple and unique
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="4"
                                        placeholder="Type your meta description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Meta Image (1200x630)</label>
                                    <div class="form-group">
                                        <label>Preview</label>
                                        <br>
                                        <div class="col d-flex p-0">
                                            <div id="meta_holder">
                                                <!-- Content of meta_holder -->
                                            </div>

                                        </div>




                                    </div>
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold">Choose Meta Image</span>
                                        <!-- choose media -->
                                        <div id="lfm2" data-input="meta_image" data-preview="meta_holder"
                                            class="tt-product-thumb mt-3 cursor-pointer">
                                            <div class="no-avatar-gallery rounded-circle ">
                                                <input id="meta_image" class="form-control" type="hidden"
                                                    name="meta_image">
                                                <span><i class="fas fa-plus"></i></span>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--seo meta description end-->


                        <button type="submit" class="btn btn-primary">Save Product</button>
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
                                        <a href="#section-1" class="active">Basic
                                            Information</a>
                                    </li>
                                    <li>
                                        <a href="#section-2">Product
                                            Images</a>
                                    </li>

                                    <li>
                                        <a href="#section-4">Category</a>
                                    </li>
                                    <li>
                                        <a href="#section-5">product Brand & Unit</a>
                                    </li>
                                    <li>
                                        <a href="#section-6">Price, SKU and Stock</a>
                                    </li>
                                    <li>
                                        <a href="#section-7">Product Discount</a>
                                    </li>
                                    <li>
                                        <a href="#section-8">Product Feature Type</a>
                                    </li>
                                    <li>
                                        <a href="#section-9">Sell Target and Status</a>
                                    </li>
                                    <li>
                                        <a href="#section-10">SEO Meta
                                            options</a>
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
        // Initialize file manager for both fields
        file_manager("lfm", "image", false, {
            prefix: route_prefix
        });
        file_manager("lfm2", "image", false, {
            prefix: route_prefix
        });

        $(document).ready(function() {
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val()
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.product.get-subcategories', [Auth::user()->username]) }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.sub-category').html(' <option value="">Select</option>')
                        $.each(data, function(i, item) {
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                })
            })


            // Get child Category
            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val()
                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.product.get-child-categories', [Auth::user()->username]) }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('.child-category').html(' <option value="">Select</option>')
                        $.each(data, function(i, item) {
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    }
                })
            })
        })
    </script>
@endpush
