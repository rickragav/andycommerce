@extends('vendor.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>

        </div>
        <div class="section-body">

            <div class="row mt-sm-4">

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{ route('vendor.profile.update', ['profile', $profile->id]) }}"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $profile->phone }}">

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $profile->email }}">

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post"
                            action="{{ route('vendor.profile.update', ['additionaldetail', $profile->id]) }}"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Update Additional Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <div class="form-group">
                                            <label>Preview</label>
                                            <br>
                                            <img src="{{ $profile->banner }}" width="200px" alt="" srcset="">
                                        </div>

                                        <div class="mb-3">
                                            <div class="input-group">
                                                <button id="lfm" data-input="banner" data-preview="banner"
                                                    class="btn btn-secondary">
                                                    <i class="bi bi-image"></i> Browse
                                                </button>

                                                <input id="banner" class="form-control" type="text" name="banner"
                                                    placeholder="Branner URL path...">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $profile->address }}">

                                    </div>
                                    <div class="form-group col-12">

                                        <label>Description</label>
                                        <textarea class="summernote" name="description">{{ $profile->description }}</textarea>

                                    </div>


                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{ route('vendor.profile.update', ['sociallink', $profile->id]) }}"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Update Social Links</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">


                                    <div class="form-group col-md-6 col-12">
                                        <label>Facebook</label>
                                        <input type="text" name="fb_link" class="form-control"
                                            value="{{ $profile->fb_link }}">

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>twitter</label>
                                        <input type="text" name="tw_link" class="form-control"
                                            value="{{ $profile->tw_link }}">

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Instagram</label>
                                        <input type="text" name="insta_link" class="form-control"
                                            value="{{ $profile->insta_link }}">

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-7">

                    <div class="card">
                        <form method="post" action="{{ route('vendor.profile.store', [Auth::user()->username]) }}"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control">

                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control">

                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">

                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
