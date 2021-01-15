@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификации колледжей':'Образовательные программы ВУЗов - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    <h1>
        @if($t == 4)
            Квалификации колледжей
        @else
            Образовательные программы ВУЗов - {{\App\Models\Degree::find($t)->name_ru}}
        @endif
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form style="display: inline" action="{{route('admin.qualification', $t)}}" method="get">
                        <input style="width: 41%; margin-right: 1rem; display: inline-block" name="q" class="form-control" placeholder="@if($t == 4)Квалификация@elseОбразовательная программа@endif" type="text" @if(isset($q)) value="{{ $q }}" @endif>
                        <input style="width: 41%; margin-right: 1rem; display: inline-block" name="op" class="form-control" placeholder="@if($t == 4)Образовательная программа@elseГруппа образовательных программ@endif" type="text" @if(isset($op)) value="{{ $op }}" @endif>
                        <button class="btn btn-info" type="submit">Поиск</button>
                    </form>
                    <a href="{{url("admin/qualification/".$t."/add")}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>{{($t == 4)?'Квалификации':'Образовательные программы'}}</th>
                                @if($t == 4)
                                     <th>Образовательные программы</th>
                                    @else
                                     <th>Группа образовательных программ</th>
                                    @endif
                                 @if($t == 1 || $t == 4)
                                     <th>Поступление в {{($t == 4)?'колледж':'ВУЗ'}}</th>
                                     @else
                                     <th>Сфера направления</th>
                                     @endif
                                 <th>Срок обучения</th>
                                 <th>Форма обучения</th>
                                 <th width="9%" colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($specialties as $k => $v)
                            <tr>
                                <td>{{ $specialties->firstItem()+$k }}</td>
                                <td>{{ $v->qualification}}</td>
                                <td>{{ $v->lpg->name_ru??'Не указано' }}</td>
                                @if($t == 4 || $t == 1)
                                    <td>{{ \App\Income::find($v->income)->name??'Не указано' }}</td>
                                    @else
                                    <td>{{ \App\Models\Sphere::find($v->sphere_id)->name_ru }}</td>
                                    @endif
                                <td>{{ $v->education_time }}</td>
                                <td>{{ \App\EducationForm::find($v->education_form)->name??'Не указано' }}</td>
                                <td>
                                    <a href="{{url("admin/qualification/".$t."/view", $v->id)}}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url("admin/qualification/".$t ."/add", $v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{ url('admin/qualification/'.$t.'/delete/'.$v->id) }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Количество {{ $count }}</td>
                                <td colspan="4" class='text-center'>{{ $specialties->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
