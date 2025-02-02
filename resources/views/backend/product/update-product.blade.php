@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Update Product
    @endsection
    @section('page-main-title')
        Update Product
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('product.submitUpdate')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if (Session::has('message'))
                            <p class="text-danger text-center">{{ Session::get('message') }}</p>
                        @endif
                        <div class="card-body">

                            <div class="row">
                                <input type="hidden" name="update_id" value="{{$row[0]->id}}">
                                <div class="mb-3 col-6">
                                    <input type="hidden" value="{{Auth::user() -> id}}" name="id">
                                    <label for="formFile" class="form-label">Name</label>
                                    <input class="form-control" type="text" name="update_name" value="{{$row[0]->name}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Quantity</label>
                                    <input class="form-control" type="text" name="update_qty" value="{{$row[0]->qty}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Regular Price</label>
                                    <input class="form-control" type="number" name="update_regular_price" value="{{$row[0]->regular_price}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Sale Price</label>
                                    <input class="form-control" type="number" name="update_sale_price" value="{{$row[0]->sale_price}}"/>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Size</label>
                                    <select name="update_size[]" class="form-control size-color" multiple="multiple">
                                        @php 
                                            $sizes = json_decode($row[0]->size, true); 
                                        @endphp
                                        <option value="m" {{ in_array('m', $sizes ?? []) ? 'selected' : '' }}>M</option>
                                        <option value="l" {{ in_array('l', $sizes ?? []) ? 'selected' : '' }}>L</option>
                                        <option value="xl" {{ in_array('xl', $sizes ?? []) ? 'selected' : '' }}>XL</option>
                                        <option value="xxl" {{ in_array('xxl', $sizes ?? []) ? 'selected' : '' }}>XXL</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Available Color</label>
                                    <select name="update_color[]" class="form-control size-color" multiple="multiple">
                                        @php 
                                            $colors = json_decode($row[0]->color, true);    
                                        @endphp
                                        <option value="black" {{ in_array('black', $colors ?? []) ? 'selected' : '' }}>Black</option>
                                        <option value="yellow" {{ in_array('yellow', $colors ?? []) ? 'selected' : '' }}>Yellow</option>
                                        <option value="white" {{ in_array('white', $colors ?? []) ? 'selected' : '' }}>White</option>
                                        <option value="blue" {{ in_array('blue', $colors ?? []) ? 'selected' : '' }}>Blue</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Category</label>
                                    <select name="update_category" class="form-control">
                                            @foreach ($category as $cate)
                                                <option value="{{$cate->id}}" @selected($cate->id == $row[0]->category_id)>{{$cate->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label text-danger">Recommend image size ..x.. pixels.</label>
                                    <input type="hidden" class="form-control" name="old_thumbnail" value="{{$row[0]->thumbnail}}">
                                    <input class="form-control" type="file" name="update_thumbnail" />
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label text-danger">Description</label>
                                    <textarea name="update_description" class="form-control" cols="30" rows="10">{{$row[0]->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Product">
                                <a href="{{route('product.view')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
