@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <br \>
                @include('inc.messages')
                <!-- BLOG POSTS LOOP STARTS HERE -->
                @if(count($posts) > 0)
                    @foreach($posts as $post)
                        <div class="card mb-4">
                            <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <!--used require laravel/helpers to help me limit the viewable strings using Str class limit method -->
                                <!-- had to wrap it inside an <object> tag because it rumbles the layout of the whole page if not-->
                                <p class="card-text"><object>{!! Str::limit($post->body, 150) !!}</object></p>
                                <a href="posts/{{ $post->id }}" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on {{ $post->created_at }} by
                                <a href="#">{{ $post->user->name }}</a>
                            </div>
                        </div>
                    @endforeach

                <!-- PAGINATION NA DI NAMAN GUMAGANA PUTANG INA -->
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item">
                        <a class="page-link" href="#">&larr; Older</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Newer &rarr;</a>
                    </li>
                </ul>

                @else
                    <h1><small>No Post Found!</small></h1>

                @endif
            </div>
@endsection
