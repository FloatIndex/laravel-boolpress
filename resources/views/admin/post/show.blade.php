@extends('admin.layouts.standard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <h1>TITLE: {{$post->title}}</h1>

            @if ($diffInDays = 1)
                <p><small>Il post è stato scritto 1 giorno fa</small></p>
            @else
                <p><small>Il post è stato scritto {{$diffInDays}} giorni fa</small></p>
            @endif

            <p><strong>SLUG: </strong><small>{{$post->slug}}</small></p>

            <p><strong>CATEGORY: </strong>{{ !empty($post->category) ? $post->category->name : 'ND' }}</p>
            
            <p>
                <strong>TAGS: </strong>
                @foreach ($post->tags as $tag)
                    <span class="badge badge-info">{{$tag->name}}</span>
                @endforeach
            </p>

            <p><strong>CONTENT: </strong>{{$post->content}}</p>

            <a class="btn btn-info" href="{{ route('admin.posts.index') }}">Back to posts list</a>

        </div>
    </div>
</div>
@endsection