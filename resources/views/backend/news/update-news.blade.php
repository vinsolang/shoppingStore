@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Update News
    @endsection
    @section('page-main-title')
        Update News
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('news.submitUpdate')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (Session::has('message'))
                            <p class="text-danger text-center">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-12">
                                    <input type="text" name="update_id" value="{{$row[0]-> id}}">
                                    <label for="formFile" class="form-label">Title</label>
                                    <input class="form-control" type="text" name="update_title" value="{{$row[0]->title}}"/>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input type="text" name="old_thumbnail" value="{{$row[0]->thumbnail}}">
                                    <input class="form-control" type="file" name="update_thumbnail" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Description</label>
                                    <textarea name="update_description" class="form-control" cols="30" rows="10">{{$row[0]->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update News</button>
                                <a href="{{route('news.view')}}" class="form-control btn btn-outline-danger mx-3 my-2">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
