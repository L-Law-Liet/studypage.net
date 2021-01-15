@extends('adminlte::page')

@section('title', 'Редактировать специальность в ВУЗе')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} специальность в ВУЗе</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/cost/add':"/admin/cost/add/$id";
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
                            <label class="col-md-3">Университет</label>
                            <div class="col-md-9">
                                <select name="university_id" class="form-control">
                                    <option></option>
                                    @foreach($university as $k => $v)
                                        <option @if(is_object($cost) && $cost->university_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Специальность</label>
                            <div class="col-md-9">
                                <select name="specialty_id" class="sp_select form-control">
                                    <option></option>
                                    @foreach($specialties as $k => $v)
                                        <option @if(is_object($cost) && $cost->specialty_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3">Язык обучения</label>
                            <div class="col-md-9">
                                <select name="language_id" class="form-control">
                                    <option></option>
                                    @foreach($languages as $k => $v)
                                        <option @if(is_object($cost) && $cost->language_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-8">Стоимость обучения</label>
                                <div class="col-md-4">
                                    <input type="number" name="price" class="form-control" @if(is_object($cost)) value="{{ $cost->price }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-8">Год</label>
                                <div class="col-md-4">
                                    <input type="number" name="year" class="form-control" @if(is_object($cost)) value="{{ $cost->year }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{--<div class="col-md-6">--}}
                                {{--<label class="col-md-8">Рейтинг специальности</label>--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<input type="number" name="rating" class="form-control" @if(is_object($cost)) value="{{ $cost->rating }}" @endif>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <label class="col-md-8">Рейтинг специальности <!--Бывшая клетка место--></label>
                                <div class="col-md-4">
                                    <input type="number" name="total" class="form-control" @if(is_object($cost)) value="{{ $cost->total }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-8">Количество грантов на казахское отделение</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" name="number_grants_kz" @if(is_object($cost)) value="{{ $cost->number_grants_kz }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-8">Количество грантов на русское отделение</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" name="number_grants_ru" @if(is_object($cost)) value="{{ $cost->number_grants_ru }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-8">Проходной балл на казахское отделение</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" name="passing_score_kz" @if(is_object($cost)) value="{{ $cost->passing_score_kz }}" @endif>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-8">Проходной балл на русское отделение</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" name="passing_score_ru" @if(is_object($cost)) value="{{ $cost->passing_score_ru }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-md-8">Проходной балл на платное обучение</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="text" name="passing_score" @if(is_object($cost)) value="{{ $cost->passing_score }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Источник</label>
                            <div class="col-md-9">
                                <input class="col-md-4 form-control" type="text" name="source" @if(is_object($cost)) value="{{ $cost->source }}" @endif>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/chosen.jquery.min.js"></script>
    <script>setTimeout(function () { $('.sp_select').chosen();  alert(); }, 1200);</script>
@endsection

