@extends('layouts.app')

@section('content')

    <div class="container">
        <h3 class="text-center">
            <strong>КАЛЬКУЛЯТОР ЕНТ: УЗНАЙТЕ КАКИЕ У ВАС ШАНСЫ ПОСТУПИТЬ</strong>
        </h3>
        <p class="text-center">Укажи предметы и баллы ЕНТ и узнай, на какие программы вузов твои шансы поступить выше.<br>Если  баллы каких-то предметов не известны, попробуйте смоделировать их.</p>
        <form action={{ URL::action("СalculatorController@postResult") }} method="POST" class="m-t-35">
            @csrf
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="language_id" id="" class="form-control">
                                <option value="">Выберите язык</option>
                                @foreach($languages as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-6">Математическая грамотность</label>
                        <div class="col-md-6">
                            <input type="number" name="math" class="form-control" value="{{ old('math') }}" placeholder="Балл">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6">Грамотность чтения</label>
                        <div class="col-md-6">
                            <input type="number" name="literacy" class="form-control" value="{{ old('email') }}" placeholder="Балл">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6">История Казахстана</label>
                        <div class="col-md-6">
                            <input type="number" name="history" class="form-control" value="{{ old('email') }}" placeholder="Балл">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="subject_id" id="" class="form-control">
                                <option value="">1-й профильный предмет</option>
                                @foreach($subjects as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="subject_id2" id="" class="form-control">
                                <option value="">2-й профильный предмет</option>
                                @foreach($subjects as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="number" name="subject_1_ball" class="form-control" value="{{ old('subject_1_ball') }}" placeholder="Балл">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="number" name="subject_2_ball" class="form-control" value="{{ old('subject_2_ball') }}" placeholder="Балл">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="clearfix">
                        <button class="btn btn-success float-right">Узнать шансы поступить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
