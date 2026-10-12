@extends('layouts.dashboard.app')
@section('title')
Authorization
@endsection
@section('body')
   <div class="col-10 text-left mb-3">
    <a href="{{ route('admin.authorizations.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        Create Role
    </a>
</div>
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Authorization Managment</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>

                   <div class="card-body">

    <form action="{{ url()->current() }}" method="get"> 

        {{-- <div class="row">

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

            <div class="col-2 pl-3">
                <div class="form-group">
                    <button type="submit" class="btn btn-info ">
                        Search
                    </button>
                </div>
            </div>

        </div> --}}

    </form>

</div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                     
                                    </tfoot>
                                   <tbody>
                                       @forelse ($authorizations as $authorization )
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$authorization->role}}</td>
                                            <td>
                                            @foreach ($authorization->permissions as $permission)
                                                {{$permission}},
                                            @endforeach
                                            </td>
                                            <td>{{$authorization->created_at}}</td>
                                            <td>
                                             <a href="javascript:void(0)" onclick="if(confirm('delete this role ')){document.getElementById('delete_role_{{$authorization->id}} ').submit()}"><i class="fa fa-trash"></i></a>
                                             <a href="{{route('admin.authorizations.edit' , $authorization->id)}}"><i class="fa fa-edit"></i></a>
                                             

                                             


                                            </td>
                                        </tr>
                                        <form id="delete_role_{{$authorization->id}} " action="{{route('admin.authorizations.destroy' , $authorization->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                             </form> 
                                           
                                       @empty
                                           
                                       @endforelse
                                   </tbody>
                                </table>
                                {{$authorizations->appends(request()->input())-> links()}}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
@endsection