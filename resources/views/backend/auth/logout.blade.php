@extends('backend.master')
@section('site-title')
    LOGOUT USER
@endsection

@section('content')
    <div class="row mx-3 my-2">
                <div class="col-xl-12">
                  <!-- HTML5 Inputs -->
                  <div class="card mb-4">
                    <h5 class="card-header">
                        @yield('site-title')
                    </h5>
                    <form action="{{route('logout.submit')}}" method="post">
                        @csrf
                        <div class="card-body">
                        <div class="mb-3 row">
                        </div>
                        <p>Are you sure do you went to logout?</p>
                        <div class="mb-3 mt-4">
                            <button type="submit" class="btn btn-outline-primary">logout Now</button>
                            <a href="{{route('deshboard')}}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                        </div>
                    </form>
                  </div>
                </div>
    </div>
@endsection