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
                        <h2 class="h5 mb-lg-0">Update Variation</h2>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">



                    <form action="{{ route('vendor.products-variant.update', [Auth::user()->username, $variant->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')

                        <!--variation info start-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">Basic Information</h5>

                                <div class="mb-4">
                                    <label for="name" class="form-label">Variation Name</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="Type variation name" required value="{{ $variant->name }}">

                                </div>

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
