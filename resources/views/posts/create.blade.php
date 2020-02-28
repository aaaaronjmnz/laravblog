@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- HEADER TITLE -->
                <h1 class="my-4">Create New Post</h1>

                <!-- FORM TAGS GOES HERE FOR CREATING POSTS -->
                <div class="col-md-auto">
                    @include('inc.messages')
                    {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('body', 'Body') }}
                            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body',  'id' => 'summary-ckeditor']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('Cover Image ') }} <br \>
                            {{ Form::file('cover_image') }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Submit', ['class' => 'btn btn-outline-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
        </div>

    <!-- bootstrap and js scripts -->
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>CKEDITOR.replace( 'summary-ckeditor' );</script>

@endsection
