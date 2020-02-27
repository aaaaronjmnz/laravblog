@if(Request::path() === '/')
    @include('inc.sidebar')
@elseif(Request::path() === 'posts')
    @include('inc.sidebar')
@elseif(Request::path() === 'about')
    @include('inc.sidebar')
@elseif(Request::path() === 'contact')
    @include('inc.sidebar')
@endif
