@extends('adminlte::page')

@section('title', 'Просмотр ВУЗа')

@section('content_header')
    <h1>Просмотр страницу {{!str_contains(url()->current(), 'college')?'ВУЗа':'колледжа'}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-view">
                        <tr>
                            <th>Название {{!str_contains(url()->current(), 'college')?'ВУЗа':'колледжа'}}{{-- на русском--}}</th>
                            <td colspan="2">{{ $university->name_ru }}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>Изображение</th>--}}
{{--                            <td><img src="/img/universities/{{ $university->image }}" alt="{{ $university->name_ru }}" width="100px"></td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Информация</th>--}}
{{--                            <td class="row">--}}
{{--                                <div class="col-md-3 row">--}}
{{--                                    <label class="col-md-7">Общежитие:</label>--}}
{{--                                    <div class="col-md-5">--}}
{{--                                        @if(is_null($university->dormitory))--}}
{{--                                            Не указано--}}
{{--                                        @else--}}
{{--                                            {{($university->dormitory)?'Да':'Нет'}}--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4 row">--}}
{{--                                    <label class="col-md-8">Военная кафедра:</label>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        @if(is_null($university->military_dep))--}}
{{--                                            Не указано--}}
{{--                                            @else--}}
{{--                                        {{($university->military_dep)?'Да':'Нет'}}--}}
{{--                                            @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 row">--}}
{{--                                    <label class="col-md-3">Веб-сайт:</label>--}}
{{--                                    <div class="col-md-9">--}}
{{--                                        {{ $university->web_site??'Не указано' }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>О {{!str_contains(url()->current(), 'college')?'ВУЗе':'колледже'}}</th>
                            <td colspan="2">{!! $university->description !!}</td>
                        </tr>
                        {{--<tr>
                            <th>Название ВУЗа на казахском</th>
                            <td>{{ $university->name_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Достижения</th>
                            <td colspan="2">{!! $university->achievements !!}</td>
                        </tr>
                        <tr>
                            <th>Сотрудничество</th>
                            <td colspan="2">{!! $university->coop !!}</td>
                        </tr>
                        {{--<tr>
                            <th>Адрес (каз)</th>
                            <td>{{ $university->address_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Рейтинг</th>
                            <td colspan="2">{!! $university->rating !!}</td>
                        </tr>
                        <tr>
                            <th>Гранты/Скидки</th>
                            <td colspan="2">{!! $university->grants !!}</td>
                        </tr>
                        <tr>
                            <th>Образовательные программы</th>
                            <td colspan="2">{!! $university->learn_program !!}</td>
                        </tr>
                        <tr>
                            <th>Документы для поступления</th>
                            <td colspan="2">{!! $university->docs_income !!}</td>
                        </tr>
                        <tr>
                            <th>Контакты</th>
                            <td colspan="2">{!! $university->short_description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
