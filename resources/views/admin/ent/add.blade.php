@extends('adminlte::page')

@section('title', 'Редактировать калькулятор ЕНТ')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} калькулятор ЕНТ</h1>
@stop

@section('content')
    @php
           $action = is_null($id)?"/admin/calculator-ent/add":"/admin/calculator-ent/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Название ВУЗа и Группа образовательных программ</label>
                            <div class="col-md-9">
                                    <select id="ajaxEnt" required name="id" class="form-control">
                                        <option value=""></option>
                                        @if($id)
                                            <option selected value="{{$id}}">{{\App\Models\CostEducation::find($id)->relUniversity->name_ru??''}} - {{ \App\Models\CostEducation::find($id)->relSpecialty->lpg->name_ru??''}} - {{ \App\Models\CostEducation::find($id)->relSpecialty->qualification??''}}</option>
                                        @endif
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Проходной балл (КАЗ)</label>
                            <div class="col-md-9">
                                <input type="number" name="passing_score_kz" class="pass_score form-control" @if(is_object($education_form)) value="{{ $education_form->passing_score_kz }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Проходной балл (РУС)</label>
                            <div class="col-md-9">
                                <input type="number" name="passing_score_ru" class="pass_score form-control" @if(is_object($education_form)) value="{{ $education_form->passing_score_ru }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Проходной балл на платное</label>
                            <div class="col-md-9">
                                <input required type="number" name="paid_score" class="form-control" @if(is_object($education_form)) value="{{ $education_form->paid_score }}" @endif >
                            </div>
                        </div>

                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!$id)
        <script !src="">
            $(document).ready( function () {
                $('#ajaxEnt').select2({
                    ajax: {
                        url: "{{route('admin.ent.select')}}",
                        dataType: 'json',
                        type: "GET",
                        data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                        processResults: function (data) {
                            console.log(data);
                            return {
                                results : data
                            };
                        },
                        cache: true
                    },
                    "language": {
                        "noResults": function(){
                            return "Ничего не найдено";
                        },
                        searching: function() {
                            return "Поиск...";
                        },
                        load: function () {
                            return "gg";
                        }

                    },
                    width: '100%'
                });
            });
        </script>
    @endif
@endsection
