@extends('adminlte::page')

@section('title', 'Группа образовательных программ')

@section('content_header')
    <h1>
        @if($degree_id < 4)
            Группа образовательных программ - {{\App\Models\Degree::find($degree_id)->name_ru}}
            @else
            Образовательные программы колледжей
        @endif
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form style="display: inline" action="{{route('admin.group', $degree_id)}}" method="get">
                        <input style="width: 84%; margin-right: 1rem; display: inline-block" name="search" class="form-control" placeholder="{{($degree_id == 4)?'Образовательная программа':'Группа образовательных программ'}}" type="text" @if(isset($search)) value="{{ $search }}" @endif>
                        <button class="btn btn-info" type="submit">Поиск</button>
                    </form>
                    <a href="{{url("admin/group/".$degree_id."/add")}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="30%">{{($degree_id < 4)?'Группы образовательных программ ':'Образовательные программы'}}</th>
                                @if($degree_id < 4)
                                     <th width="20%">Направления подготовки</th>
                                    @else
                                     <th width="20%"></th>
                                    @endif
                                <th width="8%" colspan="2" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($learn_program_groups as $k => $v)
                            <tr>
                                <td>{{ $learn_program_groups->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru??'' }}</td>
                                @if($degree_id < 4)

                                    <td>{{ $v->relSubdirection->name_ru??'' }}</td>
                                    @else
                                    <td></td>
                                    @endif
{{--                                <td>--}}
{{--                                    <a href="/admin/group/view/{{ $v->id }}">--}}
{{--                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>
                                    <a href="{{url('admin/group', [$degree_id, "add", $v->id])}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{ url('admin/group', [$degree_id, "delete", $v->id]) }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="10%">Количество {{ $count }}</td>
                                <td colspan="3" class='text-center'>{{ $learn_program_groups->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
