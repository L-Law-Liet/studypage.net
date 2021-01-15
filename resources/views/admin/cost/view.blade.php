@extends('adminlte::page')

@section('title', 'Просмотр специальности в ВУЗе')

@section('content_header')
    <h1>Просмотр специальности в ВУЗе</h1>
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
                            <th>Наименование ВУЗа{{-- на русском--}}</th>
                            <td>{{ $university->name_ru }}</td>
                        </tr>
                        @if(is_object($cost->relSpecialty))
                            <tr>
                                <th>Специальность</th>
                                <td>{{ $cost->relSpecialty->cipher }} - {{ $cost->relSpecialty->name_ru }}</td>
                            </tr>
                        @endif
                        {{--<tr>
                            <th>Наименование ВУЗа на казахском</th>
                            <td>{{ $university->name_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Город</th>
                            <td>{{ $city->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Адрес</th>
                            <td>{{ $university->address_ru }}</td>
                        </tr>
                        {{--<tr>
                            <th>Адрес (каз)</th>
                            <td>{{ $university->address_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Телефон</th>
                            <td>{{ $university->phone }}</td>
                        </tr>
                        <tr>
                            <th>Краткая информация</th>
                            <td>{{ $university->information_ru }}</td>
                        </tr>
                        <tr>
                            <th>Год</th>
                            <td>{{ $cost->year }}</td>
                        </tr>
                        <tr>
                            <th>Рейтинг специальности</th>
                            <td>{{ $cost->rating }}</td>
                        </tr>
                        <tr>
                            <th>Место</th>
                            <td>{{ $cost->total }}</td>
                        </tr>
                        <tr>
                            <th>Количество грантов на русское отделение</th>
                            <td>{{ $cost->number_grants_ru }}</td>
                        </tr>
                        <tr>
                            <th>Количество грантов на казахское отделение</th>
                            <td>{{ $cost->number_grants_kz }}</td>
                        </tr>
                        <tr>
                            <th>Проходной балл на русское отделение</th>
                            <td>{{ $cost->passing_score_ru }}</td>
                        </tr>
                        <tr>
                            <th>Проходной балл на казахское отделение</th>
                            <td>{{ $cost->passing_score_kz }}</td>
                        </tr>
                        <tr>
                            <th>Проходной балл на платное обучение</th>
                            <td>{{ $cost->passing_score }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection