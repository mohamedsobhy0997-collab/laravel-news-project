@extends('layouts.frontend.app')
@section('title')
Search News
@endsection
@section('body')

    <div class="main-news">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              @foreach($posts as $post)
              <div class="col-md-4">
                <div class="mn-img">
                  <img src="{{ $post->images->first()->path}}" />
                  <div class="mn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }}</a>
                  </div>
                </div>
              </div>
              @endforeach
              
              <div class="col-12 my-3">
                 
              </div>
            </div>
             {{ $posts->links() }}
          </div>

          
        </div>
      </div>
    </div>

@endsection