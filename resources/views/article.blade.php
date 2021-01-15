@extends('layouts.app')

@section('title', $article->s_title??' ')
@section('description', $article->s_description??' ')
@section('keywords', $article->s_keywords??' ')

@section('content')
    <div class="container">
        <h3 class="text-center"><strong>{{ $article->title }}</strong></h3>
        <div id="description" class="text-justify">
            {!! $article->description !!}
        </div>
        @if(Request::path() == 'add')
            @include('proposal')
        @endif
    </div>
@endsection
