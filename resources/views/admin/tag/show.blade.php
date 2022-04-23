@extends('admin.layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h1>{{$tag->name}}</h1>

            <p><small>Slug: {{$tag->slug}}</small></p>
            
            <div>
                <ul>
                    @foreach ($tag->posts as $post)
                        <li>
                            <a class="btn btn-link" href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a class="btn btn-info" href="{{ route('admin.tags.index') }}">Back to tags list</a>

        </div>
    </div>
</div>
@endsection