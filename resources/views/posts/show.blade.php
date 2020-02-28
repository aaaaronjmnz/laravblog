@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <br \>
                <a href="/posts" class="btn btn-outline-primary"><?= '< Go Back'; ?></a>
                <br \>
                <br \>

                <!-- SHOW TITLE AND BODY -->
                <img class="card-img-top" src="/storage/cover_images/{{ $post->cover_image }}">
                <h2 class="my-4">{{ $post->title }}</h2>
                {!! $post->body !!}

                <!-- ENCLOSING DATE AND AUTHOR -->
                <hr>
                <i><small>{{ $post->created_at }}</small></i> <small>by <strong>{{ $post->user->name }}</strong></small>

                <!-- EDIT AND DELETE BUTTON GOES HERE -->
                @auth
                    @if(Auth::user()->id == $post->user_id)
                        {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'PUT', 'class' => 'float-right']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger', 'onclick' => 'return confirm("Delete this post?")']) }}
                        {!! Form::close() !!}
                        <a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-dark float-md-right">Edit</a>
                    @endif
                @endauth

                <!-- COMMENTS SECTION -->
                <br \> <br \>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group shadow-textarea">
                            <h4>Comments</h4>
                            @if (Auth::check())
                                @include('inc.messages')
                                {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                                <p>{{ Form::textarea('body', old('body'), ['class' => 'md-textarea form-control', 'rows' => '2']) }}</p>
                                {{ Form::hidden('post_id', $post->id) }}
                                <p>{{ Form::submit('Send') }}</p>
                                {{ Form::close() }}
                            @endif
                            @forelse ($post->comments as $comment)
                                <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
                                <p>{{ $comment->body }}</p>
                                <hr>
                            @empty
                                <p>This post has no comments</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

    @include('inc.sidebar')
@endsection
