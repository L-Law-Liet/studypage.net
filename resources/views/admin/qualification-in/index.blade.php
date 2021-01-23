@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификации в колледжах':'Образовательные программы ВУЗов - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    <h1>
        @if($t == 4)
            Квалификации в колледжах
        @else
            Образовательные программы в ВУЗах - {{\App\Models\Degree::find($t)->name_ru}}
        @endif
    </h1>
@stop
<style>
    table * {
        font-size: 12px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form style="display: inline" action="{{route('admin.qualification-in', $t)}}" method="get">
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="n" class="form-control" placeholder="Название @if($t == 4)колледжа@elseВУЗа@endif" type="text" @if(isset($n)) value="{{ $n }}" @endif>
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="q" class="form-control" placeholder="@if($t == 4)Квалификация@elseОбразовательная программа@endif" type="text" @if(isset($q)) value="{{ $q }}" @endif>
                        <input style="width: 27%; margin-right: 1rem; display: inline-block" name="op" class="form-control" placeholder="@if($t == 4)Образовательная программа@elseГруппа образовательных программ@endif" type="text" @if(isset($op)) value="{{ $op }}" @endif>
                        <button class="btn btn-info" type="submit">Поиск</button>
                    </form>
                    <a href="{{url('admin/qualification-in/'.$t.'/add')}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Названия {{($t == 4)?'колледжей': 'ВУЗов'}}</th>
                                 <th>{{($t == 4)?'Квалификации':'Образовательные программы'}}</th>
                                 @if($t == 4)
                                     <th>Образовательные программы</th>
                                 @else
                                     <th>Группа образовательных программ</th>
                                 @endif
                                 <th>
                                     @if($t < 2 || $t > 3)
                                         Поступление в {{($t == 4)?'колледж':'ВУЗ'}}
                                     @elseif($t == 2)
                                         Сфера направления
                                     @endif
                                 </th>
                                 <th>Срок обучения</th>
                                 <th>Форма обучения</th>
                                 <th>Стоимости</th>
                                 <th>Год обучение</th>
                                 <th width="9%" colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($specialties as $k => $v)
                            <tr>
                                <td>{{ $specialties->firstItem()+$k }}</td>
                                <td>{{ $v->relUniversity->name_ru??'Не указано' }}</td>
                                <td>{{ $v->relSpecialty->qualification??'Не указано' }}</td>
                                <td>{{ $v->relSpecialty->lpg->name_ru??'Не указано' }}</td>
                                <td>
                                    @if($t < 2 || $t > 3)
                                        {{ $v->relSpecialty->relIncome->name??'Не указано' }}
                                    @elseif($t == 2)
                                        {{ $v->relSpecialty->relSphere->name_ru??'Не указано' }}
                                    @endif
                                </td>
                                <td>{{ $v->relSpecialty->education_time??'Не указано' }}</td>
                                <td>{{ $v->relSpecialty->relEducationForm->name??'Не указано' }}</td>
                                <td>{{ $v->price??'-' }}</td>
                                <td>{{ $v->year??'Не указано' }}</td>
                                <td>
                                    <a href="{{url('admin/qualification-in/'.$t.'/view/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('admin/qualification-in/'.$t.'/add/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{ url('admin/qualification-in/'.$t.'/delete/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Количество {{ $count }}</td>
                                <td colspan="3" class='text-center'>{{ $specialties->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
