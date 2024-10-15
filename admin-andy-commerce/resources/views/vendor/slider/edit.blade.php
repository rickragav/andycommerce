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
                            <h4>Edit Slider</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{route('vendor.slider.update',['username' => Auth::user()->username, 'slider' => $slider->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{asset($slider->banner)}}" width="200px" alt="" srcset="">
                                </div>

                                <div class="input-group mb-3">
                                    <button id="lfm" data-input="banner" data-preview="holder" class="btn btn-primary">
                                        <i class="bi bi-image"></i> Browse Banner
                                      </button>

                                      <input id="banner" class="form-control" type="text" name="banner" placeholder="Image URL or path...">
                                </div>



                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" class="form-control" value="{{$slider->type}}">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$slider->title}}">
                                </div>
                                <div class="form-group">
                                    <label>Sub Title</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{$slider->subtitle}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control" value="{{$slider->description}}">
                                </div>
                                <div class="form-group">
                                    <label>Starting Price</label>
                                    <input type="text" name="starting_price" class="form-control" value="{{$slider->starting_price}}">
                                </div>
                                <div class="form-group">
                                    <label>Button Url</label>
                                    <input type="text" name="btn_url" class="form-control" value="{{$slider->btn_url}}">
                                </div>
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" name="serial" class="form-control" value="{{$slider->serial}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$slider->status == 1 ? 'selected': ''}} value="1">Active</option>
                                        <option {{$slider->status == 0 ? 'selected': ''}} value="0">Inactive</option>
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
