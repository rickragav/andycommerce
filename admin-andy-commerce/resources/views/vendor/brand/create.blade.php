@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Brand</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('vendor.brand.store', ['username' => Auth::user()->username]) }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf



                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Logo</label>
                                    <div class="input-group">
                                        <button id="lfm" data-input="banner" data-preview="holder"
                                            class="btn btn-secondary">
                                            <i class="bi bi-image"></i> Browse
                                        </button>
                                        <input id="banner" class="form-control" type="text" name="logo"
                                            placeholder="Logo URL or path...">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">IS Featured</label>
                                    <select id="inputState" class="form-control" name="is_featured">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
