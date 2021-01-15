@extends('adminlte::page')

@section('title', 'Просмотр ВУЗа')

@section('content_header')
    <h1>Просмотр {{str_contains(url()->current(), 'university')?'ВУЗа':'колледжа'}}</h1>
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
                            <th>Название {{str_contains(url()->current(), 'university')?'ВУЗа':'колледжа'}}{{-- на русском--}}</th>
                            <td>{{ $university->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Подразделение</th>
                            <td>{!! $university->subdivision !!}</td>
                        </tr>
                        {{--<tr>
                            <th>Название ВУЗа на казахском</th>
                            <td>{{ $university->name_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Регион</th>
                            <td>{{ $city->name }}</td>
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
                            <th>Индекс</th>
                            <td>{{ $university->postcode }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $university->email??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{{ $university->web_site??'Не указано' }}</td>
                        </tr>

                        @if(str_contains(url()->current(), 'university'))
                            <tr>
                                <th>Тип учебного заведения</th>
                                <td>{{ !is_null($university->relType) ? $university->relType->name_ru : '' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
