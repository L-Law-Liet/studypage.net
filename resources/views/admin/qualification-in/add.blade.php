@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификация колледжа':'Образовательная программа ВУЗа - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} {{($t == 4)?'квалификации в колледжах':'образовательную программу в ВУЗах - '.\App\Models\Degree::find($t)->name_ru}}</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?"/admin/qualification-in/$t/add":"/admin/qualification-in/$t/add/$id";
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
                            <label class="col-md-3">Название {{($t == 4)?'колледжа':'ВУЗа'}}</label>
                            <div class="col-md-9">
                                    <select required name="university_id" class="seLect2 form-control city ">
                                        <option></option>
                                        @foreach($universities as $k => $v)
                                            <option @if(is_object($cost_education) && $cost_education->university_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">{{($t == 4)?'Квалификация':'Образовательная программа'}}</label>
                            <div class="col-md-9">
                                    <select required name="specialty_id" class="city seLect2 form-control">
                                        <option></option>
                                        @foreach($qualifications as $q)
                                            <option @if(is_object($cost_education) && $cost_education->specialty_id == $q->id) selected @endif value="{{ $q->id }}">{{ $q->qualification }} - {{$q->lpg->name_ru}} @if($t > 3 || $t < 2) {{($q->relIncome)?'- '.$q->relIncome->name:''}} @elseif($t == 2) {{($q->relSphere)?'- '.$q->relSphere->name_ru:''}} @endif - {{$q->education_time}} - {{$q->relEducationForm->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                            <div class="form-group row">
                                <label class="col-md-3">Язык обучения</label>
                                <div class="col-md-9">
                                    <select required name="language_id" class="form-control city">
                                        <option></option>
                                        @foreach(\App\Models\Language::all() as $i)
                                            <option @if(is_object($cost_education)) @if($cost_education->language_id == $i->id) selected @endif @endif value="{{ $i->id }}">{{ $i->name_ru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Стоимость обучения</label>
                                <div class="col-md-9">
                                    <input type="number" name="price" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->price??'' }}" @endif >
                                </div>
                            </div>
                        <div class="form-group row">
                            <label class="col-md-3">Год обучения</label>
                            <div class="col-md-9">
                                <input required type="number" name="year" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->year??'' }}" @endif >
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Рейтинг образовательной программы</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="rating" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->rating??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Количество выделенных грантов (каз)</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="number_grants_kz" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->number_grants_kz??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Количество выделенных грантов (рус)</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="number_grants_ru" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->number_grants_ru??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Проходной балл на грант (каз)</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="passing_score_kz" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->passing_score_kz??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Проходной балл на грант (рус)</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="passing_score_ru" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->passing_score_ru??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Проходной балл на платное</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="text" name="paid_score" class="form-control" @if(is_object($cost_education)) value="{{ $cost_education->paid_score??'' }}" @endif >--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="clearfix">
{{--                            <button class="btn btn-success pull-right">Сохранить</button>--}}
                            <input type="submit" class="btn btn-success pull-right" value="Сохранить">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
