@extends('adminlte::page')

@section('title', 'Редактировать направления рейтинга колледжей/ВУЗов')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} направления рейтинга колледжей/ВУЗов</h1>
@stop

@section('content')
    @php
           $action = is_null($id)?'/admin/rating-category/add':"/admin/rating-category/add/$id";
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
                            <label class="col-md-3">Направление</label>
                            <div class="col-md-9">
                                <input required type="text" name="name" class="form-control" @if(is_object($profile)) value="{{ $profile->name }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Колледж/ВУЗ</label>
                            <div class="col-md-9">
                                <select required class="form-control" name="forCollege" id="">
                                    <option @if(isset($profile->forCollege)) @if(!$profile->forCollege) selected @endif @endif value="1">ВУЗ</option>
                                    <option @if(isset($profile->forCollege))  @if($profile->forCollege) selected @endif @endif value="2">Колледж</option>
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
@endsection
