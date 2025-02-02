@extends('backend.master')
@section('site-title')
        View Category
@endsection

@section('content')
        <div class="row mx-4 my-2">
                <div class="card">
                  <h5 class="card-header">
                    @yield('site-title')
                  </h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Created_AT</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @foreach ($row as $category)
                            <tr>
                                <td>{{$category -> id}}</td>
                                <td>{{$category -> name}}</td>
                                <td>{{$category -> created_at}}</td>
                                <td>
                                    <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('category.update',['id'=>$category->id])}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item remove-post-key" id="" data-value="{{$category -> id}}" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0)"><i class="bx bx-trash me-1"></i> Delete</a>   
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    <small class="text-light fw-semibold">Default</small>
                    <div class="mt-3">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Launch modal
                      </button>

                      <!-- Modal -->
                      <div class="mt-3">
                        <form action="{{route('category.submitRemove')}}" method="post">
                            @csrf
                            <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this news?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                        <input type="hidden" id="remove-val" name="remove-id" value="">
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
@endsection