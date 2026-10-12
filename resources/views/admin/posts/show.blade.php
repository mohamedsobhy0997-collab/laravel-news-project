
@extends('layouts.dashboard.app')

@section('title')
    Post Details
@endsection

@section('body')

<div class="container-fluid">

    <div class="card shadow mb-4 col-10">
        <a  class="btn btn-primary" href="{{route('admin.posts.index' , ['page'=>request()->page])}}">Bake To Posts</a>
        <br>
        <div id="newsCarousel" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#newsCarousel" data-slide-to="1"></li>
                <li data-target="#newsCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

                @foreach($post->images as $image)

                    <div class="carousel-item @if($loop->index == 0) active @endif">

                        <img src="{{ asset($image->path) }}"
                             class="d-block w-100"
                             alt="First Slide">

                        <div class="carousel-caption d-none d-md-block">

                            <h5>{{ $post->title }}</h5>

                            <p>
                                <!-- {!! substr($post->desc, 0, 80) !!} -->
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

            <a class="carousel-control-prev"
               href="#newsCarousel"
               role="button"
               data-slide="prev">

                <span class="carousel-control-prev-icon"
                      aria-hidden="true"></span>

                <span class="sr-only">Previous</span>

            </a>

            <a class="carousel-control-next"
               href="#newsCarousel"
               role="button"
               data-slide="next">

                <span class="carousel-control-next-icon"
                      aria-hidden="true"></span>

                <span class="sr-only">Next</span>

            </a>

        </div>


        {{-- Post Information --}}

    
<div class="row mt-4">

    <div class="col-md-4">
        <h6>
            Publisher :
            {{ $post->user->name ?? $post->admin->name }}
            <i class="fa fa-user"></i>
        </h6>
    </div>

    <div class="col-md-4">
        <h6>
            View :
            {{ $post->num_of_views }}
            <i class="fa fa-eye"></i>
        </h6>
    </div>

    <div class="col-md-4">
        <h6>
            Created At :
            {{ $post->created_at->format('Y-m-d h:i A') }}
            <i class="fa fa-edit"></i>
        </h6>
    </div>

</div>


<div class="row mt-4">

    <div class="col-md-4">
        <h6>
            Comments :
            {{ $post->comment_able==1?'Active':'Not Active' }}
            <i class="fa fa-comments"></i>
        </h6>
    </div>

    <div class="col-md-4">
        <h6>
            Status :
            {{ $post->status==1?'Active':'Not Active' }}
            <i class="fa @if ($post->status==0)
                fa-plane
            @else
                fa fa-check-circle
            @endif"></i>
        </h6>
    </div>

    <div class="col-md-4">
        <h6>
            Category:
            {{ $post->category->name }}
            <i class="fa fa-category"></i>
        </h6>
    </div>

</div>



 <div class="sn-content">

            {{$post->small_desc}}

        </div>
        <br>

        {{-- Post Description --}}

        <div class="sn-content">

            {!! $post->desc !!}

        </div>


        {{-- Buttons --}}

        
<br>
<center>
<a class="btn btn-danger" href="javascript:void(0)" onclick="if(confirm('delete post yas or no ')){document.getElementById('delete_post_{{$post->id}} ').submit()}">Delete Post<i class="fa fa-trash"></i></a>
 <a href="{{route('admin.posts.changeStatus', $post->id)}}"><i class="fa @if($post->status==1)fa-stop @else 
 @endif "></i></a>
<a class="btn btn-primary" href="{{route('admin.posts.changeStatus', $post->id)}}"><i class="fa fa-check-circle">Change Status</i></a>

<a class="btn btn-info" href="{{route('admin.posts.edit' , $post->id)}}">Edit Post<i class="fa fa-edit"></i></a>
 
</center>
            
                                          
        </div>

    </div>


    {{-- Delete Form --}}

<form id="delete_post_{{$post->id}} " action="{{route('admin.posts.destroy' , $post->id)}}" method="post">
 @csrf
 @method('DELETE')
</form>
</div>

@endsection

