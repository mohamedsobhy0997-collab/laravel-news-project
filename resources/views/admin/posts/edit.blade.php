
@extends('layouts.dashboard.app')

@section('title')
    Edit Post
@endsection

@section('body')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-10">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <a style="margin-left: 80ch" class="btn btn-primary" href="{{route('admin.posts.index')}}">Show Post</a>
                    <h2 class="m-0 font-weight-bold">
                        Update New Post
                    </h2>
                    @if (session()->has('errors'))
                <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors')->all() as $error )
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                </div>
                    @endif
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.posts.update', $post->id) }}"
                          method="post"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">

                                    <label>Title</label>

                                    <input type="text"
                                           name="title"
                                           value="{{@old('title', $post->title)}}"
                                           placeholder="Enter title"
                                           class="form-control">
                                           

                                    @error('title')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>
                        </div>


                        {{-- Small Description --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">

                                    <label>Small Description</label>

                                    <textarea name="small_desc"
                                              placeholder="Enter post Small Description"
                                              class="form-control">{{@old('small_desc', $post->small_desc)}}</textarea>

                                    @error('small_desc')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>
                        </div>


                        {{-- Description --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">

                                    <label>Post Description</label>

                                    <textarea id="postContent"
                                              name="desc"
                                              placeholder="Enter Post Description"
                                              class="form-control">{!!@old('desc', $post->desc)!!}</textarea>

                                    @error('desc')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">

                                    <label>Images</label>

                                    <input id="post-images"
                                             multiple
                                            type="file"
                                              name="images[]"
                                              class="form-control">

                                    @error('images')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        {{-- Category & Comment Able --}}
                        <div class="row mb-3">

                            <div class="col-6">
                                <div class="form-group">

                                    <label>Category</label>

                                    <select name="category_id"
                                   
                                            class="form-control">

                                        {{-- <option selected disabled value="">
                                            Select Category
                                        </option> --}}

                                        @foreach ($categories as $category)
                                            <option @selected($category->id ==$post->category_id) value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('category_id')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">

                                    <label>Comment Able Status</label>

                                    <select name="Comment_able"
                                            class="form-control">

                                       

                                        <option value="1" @selected($post->comment_able ==1)>
                                            Active
                                        </option>

                                        <option value="0"  @selected($post->comment_able ==0)>
                                            Not Active
                                        </option>

                                    </select>

                                    @error('Comment_able')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>

                        </div>


                        {{-- Status --}}
                        <div class="row mb-4">

                            <div class="col-12">
                                <div class="form-group">

                                    <label>Status</label>

                                    <select name="status"
                                            class="form-control">

                                        <option value="1" @selected($post->status ==1)>
                                            Active
                                        </option>

                                        <option value="0" @selected($post->status ==0)>
                                            Not Active
                                        </option>

                                    </select>

                                    @error('status')
                                        <i>{{ $message }}</i>
                                    @enderror

                                </div>
                            </div>

                        </div>


                        {{-- Submit --}}
                        <div class="text-center">

                            <button type="submit"
                                    class="btn btn-primary px-5">

                                Update Post

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('js')

<script>

    $(function(){

     $('#post-images').fileinput({
   theme: 'fa5',
         maxFileCount: 5,
          allowedFileTypes: ['image'], 
          showUpload:false,
          initialPreviewAsData: true,
          initialPreview: [
    @if($post->images()->count() > 0)
        @foreach($post->images as $image)
            "{{ asset($image->path) }}",
        @endforeach
    @endif
],
    
initialPreviewConfig: [
   @if ($post->images()->count()>0)
   @foreach ($post->images as $image )
    {
        caption: "{{$image->path}}", 
        width: '120px', 
        url: "{{route('admin.posts.delete.image' , [$image->id , '_token'=>csrf_token()])}}",  
        key: "{{$image->id}}", 
      
    },
   @endforeach
   @endif
],
         
});

        $('#postContent').summernote({
            height: 300,
        });

    });

</script>

@endpush



