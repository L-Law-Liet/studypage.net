@extends('adminlte::page')

@section('title', 'Просмотр ВУЗа')

@section('content_header')
    <h1>Просмотр пользователя</h1>
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
                            <th>Фамилия</th>
                            <td>{{ $user->surname??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Имя</th>
                            <td>{{ $user->name??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Дата рождения</th>
                            <td>@if($user->birthDate){{date("d.m.Y", strtotime($user->birthDate))}}@else Не указано @endif</td>
                        </tr>
                        <tr>
                            <th>Пол</th>
                            <td>@if ($user->region) {{($user->gender == 'm')?'Мужской':'Женский'}} @else Не указано @endif</td>
                        </tr>
                        {{--<tr>
                            <th>Название ВУЗа на казахском</th>
                            <td>{{ $user->name_kz }}</td>
                        </tr>--}}
                        <tr>
                            <th>Регион</th>
                            <td>@if ($user->region) {{\App\Region::find($user->region)->name??'Не указано'}} @else Не указано @endif</td>
                        </tr>
                        <tr>
                            <th>Электронная почта</th>
                            <td>{{ $user->email??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Контактный телефон</th>
                            <td>{{ $user->phone??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Пароль</th>
                            <td>{{ $user->password??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Баланс</th>
                            <td>{{ $user->bill??'Не указано' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
