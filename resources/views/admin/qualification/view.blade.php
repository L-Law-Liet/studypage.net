@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификация колледжа':'Образовательная программа ВУЗа - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    <h1>Просмотр {{($t == 4)?'квалификацию колледжа':'образовательную программу ВУЗа - '.\App\Models\Degree::find($t)->name_ru}}</h1>
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
                            <th>{{($t == 4)?'Квалификация':'Название образовательной программы'}}</th>
                            <td>{{$specialty->qualification}}</td>
                        </tr>
                        <tr>
                            <th>{{($t == 4)?'Образовательные программы колледжей':'Группа образовательных программ - '.\App\Models\Degree::find($t)->name_ru}}</th>
                            <td>{{ \App\LearnProgramGroup::find($specialty->learn_program_group_id)->name_ru }}</td>
                        </tr>
                        <tr>
                            @if($t == 1 || $t == 4)
                                <th>{{($t == 4)?'Поступление в колледж':'Поступление в ВУЗ'}}</th>
                                <td>{{ \App\Income::find($specialty->income)->name }}</td>
                                @else
                                <th>Сфера направления</th>
                                <td>{{ \App\Models\Sphere::find($specialty->sphere_id)->name_ru }}</td>
                            @endif
                        </tr>
                        @if($t == 1)
                            <tr>
                                <th>1-й {{$prof}}</th>
                                <td>{{ \App\Models\Subject::find($specialty->subject_id)->name_ru }}</td>
                            </tr>
                            <tr>
                                <th>2-й {{$prof}}</th>
                                <td>{{ \App\Models\Subject::find($specialty->subject_id2)->name_ru }}</td>
                            </tr>
                            @endif
                        <tr>
                            <th>Срок обучения</th>
                            <td>{{ $specialty->education_time }}</td>
                        </tr>
                        <tr>
                            <th>Форма обучения</th>
                            <td>{{ \App\EducationForm::find($specialty->education_form)->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
