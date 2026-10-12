
@extends('layouts.dashboard.app')

@section('title')
    Setting
@endsection
@push('css')
<!-- Dropify CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    
@endpush

@section('body')

<center>

    <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="card shadow mb-4 col-10">

            <h2>Update Setting</h2>
            <br><br>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="site_name"
                               value="{{$get->site_name}}"
                               placeholder="Enter site_name"
                               class="form-control">
                               

                        @error('site_name')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        <input type="email"
                               name="email"
                                value="{{$get->email}}"
                               placeholder="Enter email"
                               class="form-control">

                        @error('email')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="facebook"
                                value="{{$get->facebook}}"
                               placeholder="Enter facebook link"
                               class="form-control">

                        @error('facebook')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="twitter"
                               value="{{$get->twitter}}"
                               placeholder="Enter twitter link"
                               class="form-control">

                        @error('twitter')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="instagram"
                                value="{{$get->instagram}}"
                               placeholder="Enter instagram link"
                               class="form-control">

                        @error('instagram')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="youtube"
                               value="{{$get->youtube}}"
                               placeholder="Enter youtube link"
                               class="form-control">

                        @error('youtube')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="country"
                                value="{{$get->country}}"
                               placeholder="Enter Country Name"
                               class="form-control">

                        @error('country')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="city"
                                value="{{$get->city}}"
                               placeholder="Enter City Name"
                               class="form-control">

                        @error('city')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="street"
                                 value="{{$get->street}}"
                               placeholder="Enter Street Name"
                               class="form-control">

                        @error('street')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        <input type="text"
                               name="phone"
                               value="{{$get->phone}}"
                               placeholder="Enter phone"
                               class="form-control">

                        @error('phone')
                            <i class="btn btn-danger">{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-12">
                    <div class="form-group">

                        <textarea name="small_desc"
                        placeholder="Enter small_desc"
                        class="form-control">{{$get->small_desc}}</textarea>
                        @error('small_desc')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-6">
                    <div class="form-group">

                        Logo :
                        <input type="file"
                               name="logo"
                               class="dropify"
                               class="form-control">
                                <br>
                               <img class="img-thumbnail" src="{{asset($get->logo)}}">
                        @error('logo')
                            <i class="btn btn-danger">{{ $message }}</i>
                        @enderror

                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">

                        Favicon :
                        <input type="file"
                               name="favicon"
                               class="dropify"
                               class="form-control">
                               <br>
                               <img class="img-thumbnail" src="{{asset($get->favicon)}}">
                        @error('favicon')
                            <i>{{ $message }}</i>
                        @enderror

                    </div>
                </div>

            </div>


            <br>
<input name="setting_id" value="{{$get->id}}" type="hidden">
            <button type="submit" class="btn btn-primary">
                Update Setting
            </button>

       

    </form>

</center>

@endsection
@push('js')
<!-- Dropify JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
    
@endpush


