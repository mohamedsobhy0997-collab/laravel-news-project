@extends('layouts.dashboard.app')
@section('title')
    users
@endsection
@section('body')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>

                   <div class="card-body">

    <form action="{{ url()->current() }}" method="get"> 

        <div class="row">

            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by"  class="form-control">
                        <option selected disabled value="">Sort_by</option>
                        <option value="id">Id</option>
                        <option value="name">Name</option>
                        <option value="created_at">Created At</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select name="order_by"   class="form-control">
                        <option selected disabled value="">Order_by</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select name="limit_by"  class="form-control">
                        <option selected disabled value="">Limit_by</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <select name="status"  class="form-control">
                        <option selected disabled value="">Status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                 <input  class="form-control"  name="keyword" placeholder="Search Here..." >
                </div>
            </div>

            <div class="col-1 pl-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-info ">
                        Search
                    </button>
                </div>
            </div>
            <div class="col-3">
                <div class="from-group">
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-category">
  Create Category
</button>
                </div>
            </div>

        </div>

    </form>

</div>

                        
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                             <th>post_count</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                     
                                    </tfoot>
                                   <tbody>
                                       @forelse ($categories as $category )
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->status==1?'Active': 'Not Active'}}</td>
                                            <td>{{$category->posts_count}}</td>
                                            <td>{{$category->created_at}}</td>
                                            <td>
                                            <a href="javascript:void(0)" onclick="if(confirm('delete category yas or no ')){document.getElementById('delete_category_{{$category->id}}').submit()}"><i class="fa fa-trash"></i></a>
                                            <a href="{{route('admin.categories.changeStatus', $category->id)}}"><i class="fa @if($category->status==1)fa-stop @else fa-play
                                            @endif "></i></a>
                                               <a href="javascript:void(0)"><i class="fa fa-edit" data-toggle="modal" data-target="#edit-category-{{$category->id}}"></i></a>
                                            

                                             


                                            </td>    
                                        </tr>
                                        <form id="delete_category_{{$category->id}}" action="{{route('admin.categories.destroy' , $category->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                             </form>
                                              <!-- Button trigger modal edit -->
                                             <!-- Modal -->
<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Edit Category : {{$category->name}}
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <input type="text"
                               name="name"
                               value="{{ $category->name }}"
                               class="form-control">

                        <br>

                        <select name="status" class="form-control">

                            <option disabled>Select Status</option>

                            <option value="1" @selected($category->status == 1)>
                                Active
                            </option>

                            <option value="0" @selected($category->status == 0)>
                                Not Active
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class="btn btn-primary">
                         Update Category
                    </button>

                </div>

            </div>
        </div>

    </div>

</form>
                                           
    @empty
                                      


>
                                           
                                       @endforelse
                                   </tbody>
                                </table>
                                {{$categories->appends(request()->input())-> links()}}
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->


<!-- Modal create -->
<form action="{{route('admin.categories.store')}}" method="post">
    @csrf
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">  Create New Category </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter Create Category" class="form-control">
            <br>
            <select name="status" class="form-control">
                <option disabled selected>Select Status </option>
                <option value="1">Active</option>
                <option value="0"> Not Active</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Create Category </button>

      </div>
    </div>
  </div>
</div>

</form>
                </div>
                <!-- /.container-fluid -->
@endsection