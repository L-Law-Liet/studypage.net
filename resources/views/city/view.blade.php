@extends('layouts.app')

@section('title', $city->s_title??'')
@section('description', $city->s_description??'')
@section('keywords', $city->s_keywords??'')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3 class="text-center"><strong>{{ $city->announce }}</strong></h3>
                {{--<img src="/img/cities/{{ $city->image }}" alt="{{ $city->name_ru }}" class="city-detail-img">--}}
                <div id="description">
                    {!! $city->description !!}
                </div>
            </div>
            <div class="col-md-3 right-block city-menu">
                <ul class="nav flex-column">
                    @foreach($cities as $k => $v)
                        <li class="nav-item">
                            <a class="nav-link @if($k == $city->id) active @endif" href="/qazaqstan/city/view/{{$k}}">
                                <span class="sprites @if($k == $city->id) down @else intern @endif"></span>{{$v}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
