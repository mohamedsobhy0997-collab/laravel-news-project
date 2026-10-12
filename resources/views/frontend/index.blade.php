@extends('layouts.frontend.app')
@section('title')
Home
@endsection
@section('meta_desc')
{{$get->small_desc}}
  
@endsection

@push('header')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
 

@section('breadcrumb')
@parent
  <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
@endsection


@section('body')

            @php
                $latest_three_posts = $posts->take(3);
            @endphp

    <!-- Top News Start-->
    <div class="top-news">
      <div class="container">
        <div class="row">
          <div class="col-md-6 tn-left">
            <div class="row tn-slider">
             @foreach($latest_three_posts as $post )
             <div class="col-md-6">
                <div class="tn-img">
                  <img src="{{$post->images->first()?->path}}" />
                  <div class="tn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}"
                      >{{$post->title}}</a
                    >
                  </div>
                </div>
              </div>
             @endforeach
              
            </div>
          </div>
          <div class="col-md-6 tn-right">
            @php
            $four_posts= $posts->take(4);
            @endphp
            <div class="row">
              @foreach($four_posts as $post)
               <div class="col-md-6">
                <div class="tn-img">
                  <img src="{{$post->images->first()?->path}}" />
                  <div class="tn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}">{{$post->title}}</a>
                  </div>
                </div>
              </div>
              @endforeach
             
              
                <!-- <div class="tn-img">
                  <img src="{{asset('assets/frontend')}}/img/news-350x223-4.jpg" />
                  <div class="tn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
      <div class="container">
        <div class="row">
       @foreach($categories_with_posts as $category)
          <div class="col-md-6">
            <h2>{{$category->name}}</h2>
            <div class="row cn-slider">
            @foreach($category->posts as $post)
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{$post->images->first()?->path}}" />
                  <div class="cn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}">{{$post->title}}</a>
                  </div>
                </div>
              </div>
            @endforeach
            
                <div class="cn-img">
                  <img src="{{asset('assets/frontend')}}/img/news-350x223-3.jpg" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
       @endforeach
         
        </div>
      </div>
    </div>
    <!-- <div class="cat-news">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Business</h2>
            <div class="row cn-slider">
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-5.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-4.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-3.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h2>Entertainment</h2>
            <div class="row cn-slider">
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-2.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-1.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cn-img">
                  <img src="{{asset('assets/frontend/img/news-350x223-3.jpg')}}" />
                  <div class="cn-title">
                    <a href="">Lorem ipsum dolor sit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="tab-news">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#popular">Popular News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#oldest">Oldest News</a>
              </li>
            </ul>

            <div class="tab-content">
              <div id="popular" class="container tab-pane active">
                @foreach($popular_comments as $post)
                <div class="tn-news">
                  <div class="tn-img">
                    <img src="{{ $post->images->first()?->path}}" />
                  </div>
                  <div class="tn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }} ({{ $post->comments_count }} Comments)</a>
                  </div>
                </div>
                @endforeach
              </div>

              <div id="oldest" class="container tab-pane fade">
                @foreach($oldest_news as $post)
                    <div class="tn-news">
                      <div class="tn-img">
                        <img src="{{ $post->images->first()?->path}}" />
                      </div>
                      <div class="tn-title">
                        <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }}</a>
                      </div>
                    </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
              </li>
            </ul>

            <div class="tab-content">
              <div id="m-viewed" class="container tab-pane active">
                 @foreach($latest_three_posts as $post)
                    <div class="tn-news">
                      <div class="tn-img">
                        <img src="{{ $post->images->first()?->path }}" />
                      </div>
                      <div class="tn-title">
                        <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }}</a>
                      </div>
                    </div>
                 @endforeach
              </div>

              <div id="m-read" class="container tab-pane fade">
                @foreach($gretest_posts_views as $post)
                    <div class="tn-news">
                      <div class="tn-img">
                        <img src="{{ $post->images->first()?->path }}" />
                      </div>
                      <div class="tn-title">
                        <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }} ({{ $post->num_of_views }} views)</a>
                      </div>
                    </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="main-news">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="row">
              @foreach($posts as $post)
              <div class="col-md-4">
                <div class="mn-img">
                  <img src="{{ $post->images->first()?->path}}" />
                  <div class="mn-title">
                    <a href="{{route('frontend.post.show', $post->slug )}}">{{ $post->title }}</a>
                  </div>
                </div>
              </div>
              @endforeach
              
              <div class="col-12 my-3">
                  {{ $posts->links() }}
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="mn-list">
              <h2>Read More</h2>
              <ul>
             @foreach($read_more_posts as $post)
               <li><a href="{{route('frontend.post.show', $post->slug)}}">{{$post->title}}</a></li>
             @endforeach
              
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection