@extends('adminlte::page')

@section('title', 'Редактировать рейтинг '.($t == 1)?'ВУЗов':'колледжей')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}  рейтинг {{($t == 1)?'ВУЗов':'колледжа'}}</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?"/admin/rating/$t/add":"/admin/rating/$t/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Название {{($t == 1)?'ВУЗа':'колледжа'}}</label>
                            <div class="col-md-9">
                                    <select required name="university_id" class="seLect2 form-control">
                                        <option value=""></option>
                                        @foreach($universities as $k => $v)
                                            <option @if(is_object($rating) && $rating->university_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Направление</label>
                            <div class="col-md-9">
                                <select required name="profile_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($profiles as $k => $v)
                                        <option @if(is_object($rating) && $rating->profile_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Город</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <select name="city_id" class="form-control city" id="city_id">--}}
{{--                                    <option value=""></option>--}}
{{--                                    @foreach($cities as $k => $v)--}}
{{--                                        <option @if(is_object($rating) && $rating->city_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Итого</label>
                            <div class="col-md-9">
                                <input required type="number" name="rating" class="form-control" @if(is_object($rating)) value="{{ $rating->rating }}" @endif>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
