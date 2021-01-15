@extends('adminlte::page')

@section('title', 'Калькулятор ЕНТ')

@section('content_header')
    <h1>Калькулятор ЕНТ</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form style="display: inline" action="{{route('admin.ent')}}" method="get">
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="n" class="form-control" placeholder="Название ВУЗа" type="text" @if(isset($n)) value="{{ $n }}" @endif>
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="op" class="form-control" placeholder="Группа образовательных программ" type="text" @if(isset($op)) value="{{ $op }}" @endif>
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="q" class="form-control" placeholder="Образовательная программа" type="text" @if(isset($q)) value="{{ $q }}" @endif>
                        <button class="btn btn-info" type="submit">Поиск</button>
                    </form>
                    <a href="{{url('admin/calculator-ent/add')}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="20%">Название ВУЗа</th>
                                <th width="20%">Группа образовательных программ</th>
                                 <th width="20%">Образовательная программа</th>
                                <th width="10%">Проходной балл (КАЗ)</th>
                                <th width="10%">Проходной балл (РУС)</th>
                                <th width="10%">Проходной балл на платное</th>

                                <th width="8%" colspan="2" class="text-center">Действия</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($education_forms as $k => $v)
                            <tr>
                                <td>{{ $education_forms->firstItem()+$k }}</td>
                                <td>{{ $v->relUniversity->name_ru??'' }}</td>
                                <td>{{ $v->relSpecialty->lpg->name_ru??'' }}</td>
                                <td>{{ $v->relSpecialty->qualification??'' }}</td>
                                <td>{{ $v->passing_score_kz??'' }}</td>
                                <td>{{ $v->passing_score_ru??'' }}</td>
                                <td>{{ $v->paid_score??'' }}</td>
                                <td>
                                    <a href="{{url('admin/calculator-ent/add', $v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{url('admin/calculator-ent/delete', $v->id)}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Количество {{ $count }}</td>
                                <td colspan="3" class='text-center'>{{ $education_forms->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
