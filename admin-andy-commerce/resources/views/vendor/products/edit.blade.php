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
                            <h2 class="h5 mb-lg-0">Update Product</h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form
                        action="{{ route('vendor.products.update', ['username' => Auth::user()->username, $product->id]) }}"
                        method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <!--basic information start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">Basic Information</h5>
                                <div class="mb-4">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input class="form-control" type="text" id="name" value="{{ $product->name }}"
                                        placeholder="Type your product name" name="name">
                                    <span class="fs-sm text-muted">
                                        Product name is required and recommended to be unique.
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" id="short_description" placeholder="Type your product short description" rows="5"
                                        name="short_description">{!! $product->short_description !!}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="long_description" class="form-control summernote">{!! $product->long_description !!}</textarea>
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
                                        <div style="width: 200px; height: 130px">
                                            <img src="{{ $product->meta_image }}"
                                                width="200px" height="130px" alt="" srcset="">
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
                                <input class="form-control" value="{{ $product->vedio_link }}" type="text"
                                    id="vedio_link" name="vedio_link">
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
                                                <option {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Sub Category</label>
                                        <select id="inputState" class="form-control sub-category" name="sub_category">
                                            <option value="">Select</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option
                                                    {{ $subCategory->id == $product->sub_category_id ? 'selected' : '' }}
                                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Child Category</label>
                                        <select id="inputState" class="form-control child-category" name="child_category">
                                            <option value="">Select</option>
                                            @foreach ($childCategories as $childCategory)
                                                <option
                                                    {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}
                                                    value="{{ $childCategory->id }}">{{ $childCategory->name }}
                                                </option>
                                            @endforeach
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
                                    <option value="">Select</option>
                                    @foreach ($brands as $brand)
                                        <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                        <select id="is_variant" class="form-control" name="is_variant">
                                            <option {{ $product->is_variant == 1 ? 'selected' : '' }} value="1">Yes
                                            </option>
                                            <option {{ $product->is_variant == 0 ? 'selected' : '' }} value="0">No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Product price" value="{{ $product->price }}">

                                    </div>

                                    <div class="col-md-4">

                                        <label class="form-label">Stock<span class="text-danger">*</span></label>
                                        <input type="number" min="0" name="qty" class="form-control"
                                            placeholder="Stock qty" value="{{ $product->qty }}">

                                    </div>

                                    <div class="col-md-4">

                                        <label class="form-label">SKU <span class="text-danger">*</span></label>
                                        <input type="text" name="sku" class="form-control"
                                            placeholder="Product Sku" value="{{ $product->sku }}">

                                    </div>

                                </div>
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
                                            value="{{ $product->offer_start_date }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">End Date</label>
                                        <input type="text" name="offer_end_date" class="form-control datepicker"
                                            value="{{ $product->offer_end_date }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Discount Amount</label>
                                        <input type="text" name="offer_price" class="form-control"
                                            value="{{ $product->offer_price }}">
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
                                    <option {{ $product->product_feature_type == 'new_arrival' ? 'selected' : '' }}
                                        value="new_arrival">
                                        New Arrival</option>
                                    <option {{ $product->product_feature_type == 'featured_product' ? 'selected' : '' }}
                                        value="featured_product">Featured</option>
                                    <option {{ $product->product_feature_type == 'top_product' ? 'selected' : '' }}
                                        value="top_product">
                                        Top Product</option>
                                    <option {{ $product->product_feature_type == 'best_product' ? 'selected' : '' }}
                                        value="best_product">
                                        Best Product</option>
                                </select>
                            </div>
                        </div>
                        <!--product Feature Type End-->

                        <!--product Status start-->
                        <div class="mb-4 card" id="section-9">
                            <div class="card-body">
                                <h5 class="mb-4">Product Status</h5>

                                <select id="inputState" class="form-control" name="status">
                                    <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active
                                    </option>
                                    <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive
                                    </option>
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
                                        value="{{ $product->meta_title }}" placeholder="Type meta title"
                                        class="form-control">
                                    <span class="fs-sm text-muted">
                                        Set a meta tag title. Recommended to be simple and unique
                                    </span>
                                </div>

                                <div class="mb-4">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="4"
                                        placeholder="Type your meta description">{!! $product->meta_description !!}</textarea>
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
                                            <div style="width: 200px; height: 130px">
                                                <img id="meta_holder_img" src="{{ $product->meta_image }}"
                                                    width="200px" height="130px" alt="" srcset="">
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


                        <button type="submit" class="btn btn-primary">Save Changes</button>
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

@push('scripts')
    <script>
        $(document).ready(function() {

            // Initialize file manager for both fields
            file_manager("lfm", "image", false, {
                prefix: route_prefix
            });
            file_manager("lfm2", "image", false, {
                prefix: route_prefix
            });

            $('body').on('change', '.main-category', function(e) {

                $('.child-category').html(' <option value="">Select</option>')

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
