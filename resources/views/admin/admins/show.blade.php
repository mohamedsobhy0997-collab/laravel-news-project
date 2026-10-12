@extends('layouts.dashboard.app')
@section('title')
    Create Admin
@endsection

@section('body')
   
        <div class="crad shadow mb-4 col-10">
            <h2> User : {{$admins->name}}</h2><br><br>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Name:{{$admins->name}}" class="form-control">
                    
                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Username:{{$admins->username}}" class="form-control">
                     

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value="Email:{{$admins->email}}" class="form-control">
                      

                    </div>
                </div>
                 {{-- <div class="col-6">
                    <div class="from-group">
                    <img src="{{asset($admins->image)}}" class="img-thumbnail" class="form-control">
                    </div>
                </div> --}}
            </div> 
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                    <input disabled value=" Status:{{$admins->status==1?'Active':'Not Active'}}" class="form-control">
                      
                    </div>
                </div>
         <br>
         <a href="{{route('admin.admins.changeStatus', $admins->id)}}" class="btn btn-danger"> {{$admins->status==1?'Block': 'Active'}}</a>
        <a href="javascript:void(0)" onclick="if(confirm('delete User yas or no ')){document.getElementById('delete_admin ').submit()}" class="btn btn-info"> Delete</a>
        </div>

        <form id="delete_admin" action="{{route('admin.admins.destroy' , $admins->id)}}" method="post">
             @csrf
             @method('DELETE')
        </form>

   
@endsection