@extends('layouts.app')

@section('content')
    <div style="min-height: 30vh" class="container pt-2 ">
        <div class="row">
            <div class="col-md-8 order-md-first order-last">
                <h5>{{$ratingName}}</h5>
                @if(substr($class, 1))
                <h4>{{mb_strtoupper(App\Profile::find(substr($class, 1))->name)??''}}</h4>
                @endif
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="text-center">Наименования {{($class[0] != 1)?'ВУЗов':'колледжей'}}</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $n = 1;
                    @endphp
                    @for($i = 0; $i < count($us); $i++)

                        <tr>
                            <td>{{($us[(($i == 0)?1:$i)-1]->rating == $us[$i]->rating)?$n:++$n}}</td>
                            <td>
                            @if($us[$i]->description)
                                <a class="college-list-a" href="{{route('college.view', ['name' => ($type != 2)?'college':'universities', 'id' => $us[$i]->university_id])}}">{{$us[$i]->name_ru}}</a>
                            @else
                                <a class="college-list-a passive-list-a" style="cursor: default">{{$us[$i]->name_ru}}</a>
                            @endif
                            </td>
                            <td style="">{{$us[$i]->relRegion->name??''}}</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="3"><b>Источник:</b> {{\App\Models\Social::find(18-(3-$type))->link}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 pl-0 order-md-last ml-2 ml-md-auto order-first">
                <ul class="multi-profile-list">
                @foreach(\App\Profile::where('forCollege', 2-$type)->get() as $p)
                        <li><a href="{{url('qazaqstan/navigator/rating', [($type-1)?'universities':'college', $type, $p->id])}}" @if(($class ?? '') == $type.$p->id) class="color-C11800" @endif > @if(($class ?? '') == $type.$p->id) <img src="{{asset('img/arrow-dots-red.svg')}}" alt=""> @else <img src="{{asset('img/arrow-dots-black.svg')}}" alt=""> @endif {{$p->name}} </a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
