@extends('adminlte::page')

@section('title', 'Просмотр рейтинга'.($t == 1)?'ВУЗов':'колледжа')

@section('content_header')
    <h1>Просмотр рейтинг {{($t == 1)?'ВУЗов':'колледжа'}}</h1>
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
                            <th>Направление</th>
                            <td>{{ $rating->relProfile->name??'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Название {{($t == 1)?'ВУЗа':'колледжа'}}</th>
                            <td>{{ $rating->relUniversity->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Регион</th>
                            <td>{{ $rating->relUniversity->relRegion->name??'Не указан' }}</td>
                        </tr>
                        <tr>
                            <th>Итого</th>
                            <td>{{ $rating->rating??'0' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
