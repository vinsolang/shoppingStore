@extends('backend.master')
@section('site-title')
    Add logo
@endsection

@section('content')
    <div class="row mx-3 my-2">
                <div class="col-xl-12">
                  <!-- HTML5 Inputs -->
                  <div class="card mb-4">
                    <h5 class="card-header">
                        @yield('site-title')
                    </h5>
                    <form action="{{route('logo.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Name : </label>
                            <div class="col-md-10">
                            <input class="form-control" type="text" name="name" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Thumbnail : </label>
                            <div class="col-md-10">
                            <input class="form-control" type="file" name="thumbnail" id="html5-text-input" />
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                            <a href="{{route('logo.view')}}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                        </div>
                    </form>
                  </div>
                </div>
    </div>
@endsection