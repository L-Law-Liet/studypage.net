@extends('adminlte::page')

@section('title', 'Специальности')

@section('content_header')
    <h1>Специальности</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/specialty/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Шифр</th>-
                                <th>Название специальностей</th>
                                <th>Сфера направления</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                             <tr>
                                 {{ Form::open(['method' => 'GET']) }}
                                 <td></td>
                                 <td><input class="form-control" name="cipher"></td>
                                 <td><input class="form-control" name="name_ru"></td>
                                 <td>
                                     <select name="sphere_id" class="form-control">
                                         <option></option>
                                         @foreach($sphere as $k => $v)
                                             <option value="{{ $k }}">{{ $v }}</option>
                                         @endforeach
                                     </select>
                                 </td>
                                 <td><input class="form-control" name="education_time"></td>
                                 <td colspan="3" class="text-center"><button type="submit" class="btn btn-success">Фильтр</button></td>
                                 {{ Form::close() }}
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($specialties as $k => $v)
                            <tr>
                                <td>{{ $specialties->firstItem()+$k }}</td>
                                <td>{{ $v->cipher }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>{{ (!is_null($v->relSphere)) ? $v->relSphere->name_ru : '' }}</td>
                                <td>{{ $v->education_time }}</td>
                                <td>
                                    <a href="/admin/specialty/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/specialty/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/specialty/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '2'>Количество {{ $count }}</td>
                                <td colspan = '3' class='text-center'>{{ $specialties->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection