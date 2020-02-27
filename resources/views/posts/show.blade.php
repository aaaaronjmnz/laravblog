@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <br \>
                <!-- SHOW TITLE AND BODY -->
                <a href="/posts" class="btn btn-outline-primary"><?= '< Go Back'; ?></a>
                <h2 class="my-4">{{ $post->title }}</h2>
                {!! $post->body !!}
                <hr>
                <i><small>{{ $post->created_at }}</small></i> <small>by <strong>{{ $post->user->name }}</strong></small>

                <!-- EDIT AND DELETE BUTTON GOES HERE -->
                {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'PUT', 'class' => 'float-right']) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger', 'onclick' => 'return confirm("Delete this post?")']) }}
                {!! Form::close() !!}
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-dark float-md-right">Edit</a>
            </div>

@endsection
