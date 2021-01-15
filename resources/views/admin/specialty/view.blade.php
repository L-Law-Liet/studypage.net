@extends('adminlte::page')

@section('title', 'Просмотр специальности')

@section('content_header')
    <h1>Просмотр специальности</h1>
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
                            <th>Шифр специальности</th>
                            <td>{{ $specialty->cipher }}</td>
                        </tr>
                        <tr>
                            <th>Наименование специальностей{{-- на русском--}}</th>
                            <td>{{ $specialty->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Область образования</th>
                            <td>@if(is_object($specialty->relSubdirection)){{ $specialty->relSubdirection->relDirection->name_ru }}@endif</td>
                        </tr>
                        <tr>
                            <th>Направление подгатовки</th>
                            <td>@if(is_object($specialty->relSubdirection)){{ $specialty->relSubdirection->name_ru }}@endif</td>
                        </tr>
                        <tr>
                            <th>Первый профильный предмет</th>
                            <td>@if(is_object($specialty->relSubject)){{ $specialty->relSubject->name_ru }}@endif</td>
                        </tr>
                        <tr>
                            <th>Второй профильный предмет</th>
                            <td>@if(is_object($specialty->relSubject2)){{ $specialty->relSubject2->name_ru }}@endif</td>
                        </tr>
                        <tr>
                            <th>Степень обучения</th>
                            <td>@if(is_object($specialty->relDegree)){{ $specialty->relDegree->name_ru }}@endif</td>
                        </tr>
                        <tr>
                            <th>Срок обучения</th>
                            <td>{{ $specialty->education_time }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection