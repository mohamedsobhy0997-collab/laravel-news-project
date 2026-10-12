@extends('layouts.dashboard.app')

@section('title')
Create Admin
@endsection

@section('body')

<div class="container-fluid">
<div class="row justify-content-center">

    <div class="col-10">

        {{-- Back Button --}}
        <div class="mb-3">
            <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i>
                Back To Admins
            </a>
        </div>

        <form action="{{ route('admin.admins.update', $admins->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card shadow mb-4">

                {{-- Card Header --}}
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold text-primary">
                        <i class="fa fa-user-plus"></i>
                        Edit  Admin
                    </h2>
                </div>

                <div class="card-body">

                    {{-- Name & Username --}}
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Name</label>

                                <input
                                    value="{{$admins->name}}"
                                    type="text"
                                    name="name"
                                    placeholder="Enter Admin"
                                    class="form-control"
                                >

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Username</label>

                                <input
                                 value="{{$admins->username}}"
                                    type="text"
                                    name="username"
                                    placeholder="Enter Admin username"
                                    class="form-control"
                                >

                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Email --}}
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>

                                <input
                                 value="{{$admins->email}}"
                                    type="email"
                                    name="email"
                                    placeholder="Enter Admin email"
                                    class="form-control"
                                >

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- Status & Roles --}}
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>

                                <select name="status" class="form-control">
                                    <option selected disabled value="">
                                        Select Status
                                    </option>

                                    <option value="1" @selected($admins->status == 1)>Active</option>
                                    <option value="0" @selected($admins->status == 0)>Not Active</option>
                                </select>

                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Role</label>

                                <select name="role_id" class="form-control">
                                    <option selected disabled value="">
                                        Select Role
                                    </option>

                                    @forelse ($authorizations as $authorization)
                                        <option value="{{ $authorization->id }}"@selected($admins->role_id==$authorization->id)>
                                            {{ $authorization->role }}
                                        </option>
                                    @empty
                                        <option disabled>No Role</option>
                                    @endforelse

                                </select>

                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <hr>

                    {{-- Password --}}
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>

                                <input
                                    type="password"
                                    name="password"
                                    placeholder="Enter Password"
                                    class="form-control"
                                >

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Confirm Password</label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Enter Password again"
                                    class="form-control"
                                >

                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <hr>

                    {{-- Submit Button --}}
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-plus"></i>
                            Update Admin
                        </button>
                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

</div>

@endsection
