@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9 text-center border"><strong>Шанс к поступлению на грант</strong></div>
            <div class="col-md-3 text-center border"><strong>Шанс поступление на платное</strong></div>
            <div class="col-md-3 text-center border"><strong>Высокий</strong></div>
            <div class="col-md-3 text-center border"><strong>Средний</strong></div>
            <div class="col-md-3 text-center border"><strong>Низкий</strong></div>
            <div class="col-md-3 border"></div>
            <div class="col-md-3 text-center border">
                @foreach($specilaties as $v)
                    @if(($language_id == 1 && $sum > $v->passing_score_kz && ($sum-$v->passing_score_kz) >= 10) || ($language_id == 2 && $sum > $v->passing_score_ru && ($sum-$v->passing_score_ru) >= 10))
                        <div>
                            <a href="/poisk/view/{{$v->id}}">{{ $v->cipher }} - {{ $v->name_ru }}</a>
                            <h5>{{ $v->university }}</h5>
                            <p>Проходной балл <strong>@if($language_id==1){{ $v->passing_score_kz }}@else{{ $v->passing_score_ru }}@endif</strong></p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-3 text-center border">
                @foreach($specilaties as $v)
                    @if(($language_id == 1 && $sum >= $v->passing_score_kz && ($sum-$v->passing_score_kz) <= 5) || (($language_id == 2 && $sum >= $v->passing_score_ru && ($sum-$v->passing_score_ru) <= 5)))
                        <div>
                            <a href="/poisk/view/{{$v->id}}">{{ $v->cipher }} - {{ $v->name_ru }}</a>
                            <h5>{{ $v->university }}</h5>
                            <p>Проходной балл <strong>@if($language_id==1){{ $v->passing_score_kz }}@else{{ $v->passing_score_ru }}@endif</strong></p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-3 text-center border">
                @foreach($specilaties as $v)
                    @if(($language_id == 1 && $v->passing_score_kz > $sum && ($v->passing_score_kz - $sum) <= 5) || ($language_id == 2 && $v->passing_score_ru > $sum && ($v->passing_score_ru - $sum) <= 5))
                        <div>
                            <a href="/poisk/view/{{$v->id}}">{{ $v->cipher }} - {{ $v->name_ru }}</a>
                            <h5>{{ $v->university }}</h5>
                            <p>Проходной балл <strong>@if($language_id==1){{ $v->passing_score_kz }}@else{{ $v->passing_score_ru }}@endif</strong></p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-3 text-center border">
                @foreach($specilaties as $v)
                    @if($sum >= $v->passing_score)
                        <div>
                            <a href="/poisk/view/{{$v->id}}">{{ $v->cipher }} - {{ $v->name_ru }}</a>
                            <h5>{{ $v->university }}</h5>
                            <p>Проходной балл <strong>{{ $v->passing_score }}</strong></p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
