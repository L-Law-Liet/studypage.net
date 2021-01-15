@extends('adminlte::page')

@section('title', 'Добавить направление подготовки')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}
        @if($degree_id < 4)
            группу образовательных программ - {{\App\Models\Degree::find($degree_id)->name_ru}}
        @else
            образовательную программу колледжей
        @endif
    </h1>
@stop

@section('content')
    @php
        $action = is_null($id)?"/admin/group/$degree_id/add":"/admin/group/$degree_id/add/$id";
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
                 @if($degree_id < 4)
                            <div class="form-group row">
                                <label class="col-md-3">Направление подготовки</label>
                                <div class="col-md-9">
                                    <select required name="subdirection_id" class="form-control city">
                                        <option></option>
                                        @foreach($subdirections as $k => $v)
                                            <option @if(is_object($learn_program_groups) && $learn_program_groups->subdirection_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                     @endif
                        <div class="form-group row">
                            <label class="col-md-3">{{($degree_id < 4)?'Группа образовательных программ':'Образовательная программа'}}{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="name_ru" class="form-control" @if(is_object($learn_program_groups)) value="{{ $learn_program_groups->name_ru }}" @endif >
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
@endsection
