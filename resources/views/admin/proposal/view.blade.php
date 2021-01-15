@extends('adminlte::page')

@section('title', 'Просмотр заявки')

@section('content_header')
    <h1>Просмотр заявки</h1>
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
                            <th>Имя контактного лица</th>
                            <td>{!! $proposal->contact_name !!}</td>
                        </tr>
                        <tr>
                            <th>Название учебного заведения</th>
                            <td>{!! $proposal->university_name !!}</td>
                        </tr>
                        <tr>
                            <th>Контактный телефон</th>
                            <td>{{ $proposal->contact_phone }}</td>
                        </tr>
                        <tr>
                            <th>Электронная почта</th>
                            <td>{{ $proposal->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
