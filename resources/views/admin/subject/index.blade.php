@extends('adminlte::page')

@section('title', 'Проф.')

@section('content_header')
    <h1>{{($t == 'univer')?'Профильные предметы':'Профессиональные дисциплины'}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    @if($t != 'univer')
                        <form style="display: inline" action="{{route('admin.subject', 'college')}}" method="get">
                            <input style="width: 84%; margin-right: 1rem; display: inline-block" name="n" class="form-control" placeholder="Профессиональная дисциплина" type="text" @if(isset($n)) value="{{ $n }}" @endif>
                            <button class="btn btn-info" type="submit">Поиск</button>
                        </form>
                    @endif
                    <a href="{{url('admin/subject/'.$t.'/add')}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="80%">{{($t == 'univer')?'Профильный предмет':'Профессиональная дисциплина'}}</th>
                                <th width="18%" colspan="2" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $k => $v)
                            <tr>
                                <td>{{ $subjects->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>
                                    <a href="{{url('admin/subject/'.$t.'/add/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{url('admin/subject/'.$t.'/delete/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="20%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $subjects->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
