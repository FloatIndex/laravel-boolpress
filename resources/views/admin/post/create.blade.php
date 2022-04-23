@extends('admin.layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>Create a new post</h1>

            <form method="POST" action="{{ route('admin.posts.store') }}">

                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">No category</option>
                        @foreach ($categories as $category)
                            <option {{old('category_id') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    @foreach ($tags as $tag)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10">{{old('content')}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary " href="{{ route('admin.posts.index') }}">Cancel</a>
            </form>

        </div>
    </div>
</div>
@endsection