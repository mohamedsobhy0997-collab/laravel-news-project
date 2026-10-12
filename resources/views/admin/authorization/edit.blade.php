@extends('layouts.dashboard.app')

@section('title')

Edit Role

@endsection

@section('body')

<div class="col-10 text-left mb-3">

    <a href="{{ route('admin.authorizations.index') }}" class="btn btn-primary">

        <i class="fa fa-arrow-left"></i>

        Back To Roles

    </a>

</div>

<form action="{{ route('admin.authorizations.update' , $authorization->id) }}" method="post">

    @csrf
    @method('PUT')

    <div class="card shadow mb-4 col-10">

        <div class="card-header py-3">

            <h2 class="m-0 font-weight-bold">Edit New Role</h2>

        </div>

        <div class="card-body">

            {{-- Name & Username --}}

            <div class="row mb-4">

                <div class="col-6">

                    <div class="form-group">

                        <input type="text"
                               name="role"
                               value="{{$authorization->role}}"
                               placeholder="Enter Role name"
                               class="form-control">

                        @error('role')

                            <i>{{ $message }}</i>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- Permissions --}}

            <div class="row mb-4">

                <div class="col-12">

                    <div class="form-group">

                        @foreach (config('authorization.permissions') as $key=>$value)

                            <div class="form-check mb-2">

                                <input
                                @checked(in_array($key,$authorization->permissions))
                                    value="{{$key}}"
                                    type="checkbox"
                                    name="permissions[]"
                                    class="form-check-input"
                                >

                                <label class="form-check-label">

                                    {{$value}}

                                </label>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            <br>

            <button type="submit" class="btn btn-primary">

                Update New Role

            </button>

        </div>

    </div>

</form>

@endsection
