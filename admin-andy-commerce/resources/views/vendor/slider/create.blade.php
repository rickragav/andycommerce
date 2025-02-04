@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Slider</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('vendor.slider.store', ['username' => Auth::user()->username]) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                {{-- <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div> --}}

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Banner</label>
                                    <div class="input-group">
                                      <button id="lfm" data-input="banner" data-preview="holder" class="btn btn-primary">
                                        <i class="bi bi-image"></i> Browse
                                      </button>
                                      <input id="banner" class="form-control" type="text" name="banner" placeholder="Image URL or path...">
                                    </div>

                                  </div>



                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label>Sub Title</label>
                                    <input type="text" name="subtitle" class="form-control"
                                        value="{{ old('subtitle') }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control"
                                        value="{{ old('description') }}">
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="text" name="starting_price" class="form-control"
                                        value="{{ old('starting_price') }}">
                                </div>
                                <div class="form-group">
                                    <label>Button Url</label>
                                    <input type="text" name="btn_url" class="form-control" value="{{ old('btn_url') }}">
                                </div>
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" name="serial" class="form-control" value="{{ old('serial') }}">
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
