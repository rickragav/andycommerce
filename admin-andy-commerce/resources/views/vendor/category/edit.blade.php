@extends('vendor.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>

                        </div>
                        <div class="card-body">
                            <form
                                action="{{ route('vendor.category.update', [Auth::user()->username, $category->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')


                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{asset($category->banner)}}" width="200px" alt="" srcset="">
                                </div>
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Banner</label>
                                    <div class="input-group">
                                        <button id="lfm" data-input="banner" data-preview="holder"
                                            class="btn btn-secondary">
                                            <i class="bi bi-image"></i> Browse
                                        </button>
                                        <input id="banner" class="form-control" type="text" name="banner"
                                            placeholder="Banner URL ...">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" data-icon="{{ $category->icon }}"
                                            name="icon" role="iconpicker"></button>
                                    </div>



                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
