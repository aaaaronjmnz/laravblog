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
                <h2 class="my-4"><p>{{ $post->title }}</p></h2>
                <p>{!! $post->body !!}</p>

                <!-- ENCLOSING DATE AND AUTHOR -->
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table width="100%">
                            <tr>
                                <td width="90%">
                                    <i><small>Posted on {{ $post->created_at->format('F d, Y') }}</small></i> <small>by <strong>{{ $post->user->name }}</strong></small>
                                </td>
                                    <!-- EDIT AND DELETE BUTTON GOES HERE -->
                                    @auth
                                        <td>
                                        @if(Auth::user()->id == $post->user_id)
                                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-dark">Edit</a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'PUT']) !!}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger', 'onclick' => 'return confirm("Delete this post?")']) }}
                                            {!! Form::close() !!}
                                        </td>
                                        @endif
                                    @endauth
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- COMMENTS SECTION -->
                <br \> <br \>
{{--                <div class="container">--}}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <h5>Comments</h5>
                                        <hr>
                                        @if (Auth::check())
                                            @include('inc.messages')
                                            {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                                                <p>{{ Form::textarea('body', old('body'), ['class' => 'md-textarea form-control', 'rows' => '2']) }}</p>
                                                {{ Form::hidden('post_id', $post->id) }}
                                                <p>{{ Form::submit('Send') }}</p>
                                            {{ Form::close() }}
                                        @endif
                                        @forelse ($post->comments as $comment)
                                            <table>
                                                <tr>
                                                    <td>
                                                        <strong>{{ $comment->user->name }}</strong> [{{$comment->created_at}}]
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i>{{ $comment->body }}</i>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                        @empty
                                            <p>This post has no comments</p>
                                        @endforelse
                                        <span>{{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            </div>--}}

    @include('inc.sidebar')
@endsection
