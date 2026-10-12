@extends('layouts.dashboard.app')
@section('title')
    Create User
@endsection

@section('body')
   <center>
     <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="crad shadow mb-4 col-10">
            <h2>Create New User</h2><br><br>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="name" placeholder="Enter name" class="form-control">
                        @error('name')
                        <i>{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="username" placeholder="Enter username" class="form-control">
                         @error('username')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input type="email" name="email" placeholder="Enter user email " class="form-control">
                           @error('email')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input type="file" name="image" class="form-control">
                           @error('image')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                           <select name="status"  class="form-control">
                        <option selected disabled value="">Status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                       @error('status')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="phone" placeholder=" Enter user phone" class="form-control">
                           @error('phone')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="country" placeholder=" Enter Country Name" class="form-control">
                           @error('country')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="city" placeholder=" Enter City Name" class="form-control">
                           @error('city')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input type="text" name="street" placeholder="Enter Street Name" class="form-control">
                           @error('street')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                                <select name="email_verified_at"  class="form-control">
                        <option selected disabled value="">Selected Email Status </option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                       @error('email_verified_at')
                        <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="from-group">
                        <input type="password" name="password" placeholder="Enter Password" class="form-control">
                         @error('password')
                        <i class="btn btn-danger">{{ $message }}</i>
                        @enderror

                    </div>
                </div>
                 <div class="col-6">
                    <div class="from-group">
                        <input type="password" name="password_confirmation" placeholder=" Enter Password again" class="form-control">
                         @error('password_confirmation')
                        <i>{{ $message }}</i>
                        @enderror

               
            </div>
        </div>
         </div><br>
         <button type="submit" class="btn btn-primary"> Create User</button>
        </div>

    </form>
   </center>
@endsection