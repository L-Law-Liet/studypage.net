@extends('adminlte::page')

@section('title', 'Добавить слайдер')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} слайдер</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/slider/add':"/admin/slider/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Изображение</label>

                            <div class="col-md-4">
                                <input {{isset($slider->image)?'':'required'}} type="file" accept=".png,.jpg,.jpeg," name="image">
                            </div>
                            @isset($slider->image)
                                <div class="col-md-5">
                                    <img width="150" src="{{asset('/img/sliders/'.$slider->image)}}" alt="imgm">
                                </div>
                            @endisset
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Видео</label>
                            <div class="col-md-9">
                                <input type="text" name="video" {{isset($slider->image)?'':'required'}} class="form-control" @if(is_object($slider)) value="{{ $slider->video }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Описание</label>
                            <div class="col-md-9">
                                <textarea required="required" name="text" class="form-control">@if(is_object($slider)){{ $slider->text }}@endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Отображение</label>
                            <div class="col-md-9">
                                <select name="show" class="form-control">
                                    <option @if(is_object($slider) && $slider->show == 1) selected @endif value="{{ 1 }}">Да</option>
                                    <option @if(is_object($slider) && $slider->show == 0) selected @endif value="{{ 0 }}">Нет</option>
                                </select>
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
    <script>
        jQuery(function ($) {
            var $inputs = $('input[name=image],input[name=video]');
            $inputs.on('change', function () {
                // Set the required property of the other input to false if this input is not empty.
                $inputs.not(this).prop('required', !$(this).val().length);
            });
        });
    </script>
@endsection
