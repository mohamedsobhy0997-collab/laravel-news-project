@extends('layouts.dashboard.app')
@section('title')
    Create User
@endsection

@section('body')
   
        <div class="crad shadow mb-4 col-10">
            <h2> User : {{$user->name}}</h2><br><br>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Name:{{$user->name}}" class="form-control">
                    
                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Username:{{$user->username}}" class="form-control">
                     

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value="Email:{{$user->email}}" class="form-control">
                      

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                    <img src="{{asset($user->image)}}" class="img-thumbnail" class="form-control">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                    <input disabled value=" Status:{{$user->status==1?'Active':'Not Active'}}" class="form-control">
                      

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Phone:{{$user->phone}}" class="form-control">
                     

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value="Country :{{$user->country}}" class="form-control">
                        

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" City :{{$user->city}}" class="form-control">
                      

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Street:{{$user->street}}" class="form-control">
                         

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input disabled value=" Email Status :{{$user->email_verified_at== null? 'Not Active': 'Active'}}" class="form-control">
                    </select>
                      
                    </div>
                </div>
            </div>
         <br>
         <a href="{{route('admin.users.changeStatus', $user->id)}}" class="btn btn-danger"> {{$user->status==1?'Block': 'Active'}}</a>
        <a href="javascript:void(0)" onclick="if(confirm('delete User yas or no ')){document.getElementById('delete_user ').submit()}" class="btn btn-info"> Delete</a>
        </div>

        <form id="delete_user} " action="{{route('admin.users.destroy' , $user->id)}}" method="post">
             @csrf
             @method('DELETE')
        </form>

   
@endsection