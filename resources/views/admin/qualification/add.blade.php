@extends('adminlte::page')

@section('title', ($t == 4)?'Квалификация колледжа':'Образовательная программа ВУЗа - '.\App\Models\Degree::find($t)->name_ru)

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} {{($t == 4)?'квалификацию колледжа':'образовательную программу ВУЗа - '.\App\Models\Degree::find($t)->name_ru}}</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?"/admin/qualification/$t/add":"/admin/qualification/$t/add/$id";
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
                            <label class="col-md-3">{{($t == 4)?'Квалификация':'Название образовательной программы'}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="qualification" class="form-control" @if(is_object($specialty)) value="{{ $specialty->qualification }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">{{($t == 4)?'Образовательные программы колледжей':'Группа образовательных программ'}}</label>
                            <div class="col-md-9">
                                    <select required name="learn_program_group_id" class="form-control city seLect2">
                                        <option></option>
                                        @foreach($learn_program_groups as $k => $v)
                                            <option @if(is_object($specialty) && $specialty->learn_program_group_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        @if($t == 1 || $t == 4)
                            <div class="form-group row">
                                <label class="col-md-3">{{($t == 4)?'Поступление в колледж':'Поступление в ВУЗ'}}</label>
                                <div class="col-md-9">
                                    <select required name="income" onchange="AJAX(event)" class="form-control city">
                                        <option></option>
                                        @foreach(($t == 4)?\App\Income::where('isCollege', 1)->get():\App\Income::where('isCollege', 0)->get() as $i)
                                            <option @if(is_object($specialty) && $specialty->income == $i->id) selected @endif value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="form-group row">
                                <label class="col-md-3">Сфера направления</label>
                                <div class="col-md-9">
                                    <select required name="sphere_id" class="form-control city">
                                        <option></option>
                                        @foreach(\App\Models\Sphere::all() as $i)
                                            <option @if(is_object($specialty) && $specialty->sphere_id == $i->id) selected @endif value="{{ $i->id }}">{{ $i->name_ru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        @if($t == 1)
                            <div id="Resp">
                                @include('admin.qualification.ajax')
                            </div>
                            @endif
                        <div class="form-group row">
                            <label class="col-md-3">Срок обучения</label>
                            <div class="col-md-9">
                                <input required type="text" name="education_time" class="form-control" @if(is_object($specialty)) value="{{ $specialty->education_time }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Форма обучения</label>
                            <div class="col-md-9">
                                <select required name="education_form" class="form-control city">
                                    <option></option>
                                    @foreach(\App\EducationForm::all() as $i)
                                        <option @if(is_object($specialty) && $specialty->education_form == $i->id) selected @endif value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                        <input id="specialty" type="hidden" name="specialty" @if(is_object($specialty)) value="{{ $specialty }}" @endif>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script !src="">
        function AJAX(event) {
            specialty = document.getElementById('specialty').getAttribute('value');
            income = event.target.value;
            $.ajax({
                type : 'get',
                url : '{{url('admin/qualification/ajax')}}',
                data : {'income' : income, 'specialty' : specialty},
                success:function (data) {
                    $('#Resp').html(data);
                }
            });
        }
    </script>
@endsection
