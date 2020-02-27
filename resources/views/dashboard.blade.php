@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br \>
            @include('inc.messages')
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <a href="/posts/create" class="btn btn-group-vertical">+ Create New Post</a>
                    <h5>Manage your Posts here</h5>
                    <table class="table table-striped">
                        @if(count($posts) > 0)
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><object>{!! Str::limit($post->body, 100) !!}</object></td>
                                    <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-dark">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'PUT' ]) !!}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-outline-danger', 'onclick' => 'return confirm("Delete this post?")']) }}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>You have no available post. <a href="/posts/create">Make one here!</a></td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
