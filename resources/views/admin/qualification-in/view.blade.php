@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификация колледжа':'Образовательная программа ВУЗа - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    <h1>Просмотр {{($t == 4)?'квалификации в колледжах':'образовательную программу в ВУЗах - '.\App\Models\Degree::find($t)->name_ru}}</h1>
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
                            <th>Наименование {{($t == 4)?'колледжа':'ВУЗа'}}</th>
                            <td>{{ $cost_education->relUniversity->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>{{($t == 4)?'Квалификация':'Образовательная программа'}}</th>
                            <td>{{$cost_education->relSpecialty->qualification}}</td>
                        </tr>
                        <tr>
                            <th>Язык обучения</th>
                            <td>{{ $cost_education->relLanguage->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Стоимость обучения</th>
                            <td>{{ $cost_education->price??'-' }}</td>
                        </tr>
                        <tr>
                            <th>Год обучения</th>
                            <td>{{ $cost_education->year }}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>Рейтинг образовательной программы</th>--}}
{{--                            <td>{{ $cost_education->rating }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Количество выделенных грантов (каз)</th>--}}
{{--                            <td>{{ $cost_education->number_grants_kz }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Количество выделенных грантов (рус)</th>--}}
{{--                            <td>{{ $cost_education->number_grants_ru }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Проходной балл на грант (каз)</th>--}}
{{--                            <td>{{ $cost_education->passing_score_kz }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Проходной балл на грант (рус)</th>--}}
{{--                            <td>{{ $cost_education->passing_score_ru }}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Проходной балл на платное</th>--}}
{{--                            <td>{{ $cost_education->paid_score }}</td>--}}
{{--                        </tr>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
