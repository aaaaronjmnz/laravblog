@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- HEADER TITLE -->
                <h1 class="my-4">Edit Post</h1>

                <!-- FORM TAGS GOES HERE FOR EDITING POSTS -->
                <div class="col-md-auto">
                    @include('inc.messages')
                    {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('body', 'Body') }}
                            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body',  'id' => 'summary-ckeditor']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Cover Image ') }} <br \>
                            {{ Form::file('cover_image') }}
                        </div>
                        <div class="form-group">
                            {{ Form::hidden('_method', 'PUT') }}
                            {{ Form::submit('Submit', ['class' => 'btn btn-outline-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

    <!-- JS SCRIPT FOR CK EDITOR -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>CKEDITOR.replace( 'summary-ckeditor' );</script>

@endsection
