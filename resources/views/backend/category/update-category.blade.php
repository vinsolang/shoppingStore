@extends('backend.master')
@section('site-title')
    Update Category
@endsection

@section('content')
    <div class="row mx-3 my-2">
                <div class="col-xl-12">
                  <!-- HTML5 Inputs -->
                  <div class="card mb-4">
                    <h5 class="card-header">
                        @yield('site-title')
                    </h5>
                    <form action="{{route('category.submitUpdate')}}" method="post">
                        @csrf
                        <div class="card-body">
                        <div class="mb-3 row">
                            <input type="hidden" name="update_id" value="{{$row[0]->id}}">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Name : </label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="update_name" id="html5-text-input" value="{{$row[0]->name}}" />
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <button type="submit" class="btn btn-outline-primary">Update Now</button>
                            <a href="{{route('category.view')}}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                        </div>
                    </form>
                  </div>
                </div>
    </div>
@endsection