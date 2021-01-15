@extends('layouts.app')
@section('css')
    <style>
        body {
            font-family: Futura PT, sans-serif;
        }
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div id="college-view-right">
            <div>
                <h3 class="text-center">По результатам теста Ваш балл составляет: <b>{{$score}}</b></h3>
            </div>
            <div>
                <table id="ent-table">
                    <thead>
                    <tr>
                        <td colspan="4" class="ent-td w-75 p-2" >{{$title}}</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
                    <tr hidden>
                        <td>“Равно” или “больше” проходного балла на грант</td>
                        <td>“Меньше с 1 по 5 баллов” чем проходной балл на грант (5)</td>
                        <td>“Меньше с 6 по 13 баллов” чем проходной балл на грант (10)</td>
                        <td>“Меньше с 14 баллов” чем проходной балл на грант, но не меньше проходного балла на платное</td>
                    </tr>
                    @php
                        $pageSize = $page*5+5;
                        if ($pageSize >  count($array)/4)
                            $pageSize = count($array)/4;
                    @endphp
                    @for($i = $page*5; $i < $pageSize; $i++)
                        <tr class="pc">
                            @php
                            $row = ($i+1)*4;
                            if ($row > ceil(count($array)))
                                $row = ceil(count($array));
                            @endphp
                            @for($j = $i*4; $j < $row; $j++)
                                    <td>
                                        <div class="justify-content-start d-flex">
                                            <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                            <b>
                                                <a class="ent-href" href="{{route('resToSearch', [$array[$j]->relSpecialty->learn_program_group_id, $array[$j]->university_id??'', $profs1, $profs2])}}">{{$array[$j]->relSpecialty->lpg->name_ru}}</a>
                                            </b>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="w-8"><i class="fas fa-building"></i></div>
                                            <p class="mb-0">
                                                <a class="ent-href" href="{{route('resToSearch', [$array[$j]->relSpecialty->learn_program_group_id, $array[$j]->university_id??'', $profs1, $profs2])}}">{{$array[$j]->relUniversity->name_ru??''}}</a>
                                            </p>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="w-8"></div>
                                            <div><b>Проходной балл:
                                                @if($type == 4)
                                                    {{$array[$j]->paid_score}}
                                                    @else
                                                    @if($lang == 1)
                                                        {{$array[$j]->passing_score_kz}}
                                                        @else
                                                        {{$array[$j]->passing_score_ru}}
                                                        @endif
                                                    @endif
                                                </b></div>
                                        </div>
                                    </td>
                                @endfor
                        </tr>

                            @php
                                $row = ($i+1)*4;
                                if ($row > ceil(count($array)))
                                    $row = ceil(count($array));
                            @endphp
                            @for($j = $i*4; $j < $row; $j++)
                                <tr class="mobile">
                                <td>
                                    <div class="justify-content-start d-flex">
                                        <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                        <b>
                                            <a class="ent-href" href="{{route('resToSearch', [$array[$j]->relSpecialty->learn_program_group_id, $array[$j]->university_id??'', $profs1, $profs2])}}">{{$array[$j]->relSpecialty->lpg->name_ru}}</a>
                                        </b>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"><i class="fas fa-building"></i></div>
                                        <p class="mb-0">
                                            <a class="ent-href" href="{{route('resToSearch', [$array[$j]->relSpecialty->learn_program_group_id, $array[$j]->university_id??'', $profs1, $profs2])}}">{{$array[$j]->relUniversity->name_ru??''}}</a>
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл:
                                                @if($type == 4)
                                                    {{$array[$j]->paid_score}}
                                                @else
                                                    @if($lang == 1)
                                                        {{$array[$j]->passing_score_kz}}
                                                    @else
                                                        {{$array[$j]->passing_score_ru}}
                                                    @endif
                                                @endif
                                            </b></div>
                                    </div>
                                </td>
                                </tr>
                            @endfor
                        @endfor
                    </tbody>
                </table>

                <div class="pc">
                    <div class="pagination-block m-2 p-2">
                        <div class="row m-1">
                            <button id="prevPage" @if($page > 0) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, ($page-1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 d-flex text-center"><img @if($page > 0) class="Img" @endif src="{{asset('img/pagination-left.svg')}}" alt=""></button>
                            <div class="col-10 text-center form-group position-relative">
                                <div id="select-div2">
                                    <select id="pagination-select2" class="custom-control-inline border-0 m-0 ml-5" style="outline: 0" onchange="javascript:location.href = this.value;">
                                        @for($i = 0; $i < ceil(count($array)/20); $i++)
                                            @if($i == $page)
                                                <option value="" hidden selected>{{(1+$page)}} из {{ceil(count($array)/20)}}</option>
                                                <option class="font-weight-bold" value="" disabled>Страница {{$i+1}}</option>
                                            @else
                                                <option class="nPage" value="{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, $i])}}">Страница {{$i+1}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                    {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                                </div>
                            </div>
                            <button id="nextPage" @if($page < ceil(count($array)/20)-1) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, ($page+1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 d-flex text-center"><img @if($page < ceil(count($array)/20)-1) class="Img" @endif src="{{asset('img/pagination-right.svg')}}" alt=""></button>
                        </div>
                    </div>
                </div>
                <div class="mobile">
                    <div class="pagination-block m-2 p-2">
                        <div class="row m-1">
                            <button id="prevPage" @if($page > 0) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, ($page-1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 d-flex text-center"><img @if($page > 0) class="Img" @endif src="{{asset('img/pagination-left.svg')}}" alt=""></button>
                            <div class="col-9 text-center form-group position-relative">
                                <div id="select-div2">
                                    <select id="pagination-select2" class="custom-control-inline border-0 m-0 ml-5" style="outline: 0" onchange="javascript:location.href = this.value;">
                                        @for($i = 0; $i < ceil(count($array)/20); $i++)
                                            @if($i == $page)
                                                <option value="" hidden selected>{{(1+$page)}} из {{ceil(count($array)/20)}}</option>
                                                <option class="font-weight-bold" value="" disabled>Страница {{$i+1}}</option>
                                            @else
                                                <option class="nPage" value="{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, $i])}}">Страница {{$i+1}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                    {{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                                </div>
                            </div>
                            <button id="nextPage" @if($page < ceil(count($array)/20)-1) onclick="window.location='{{route('result-ent2', [$type, encrypt($score), $profs1, $profs2, $lang, ($page+1)])}}'" style="cursor: pointer" @else disabled @endif class="col-1 d-flex text-center"><img @if($page < ceil(count($array)/20)-1) class="Img" @endif src="{{asset('img/pagination-right.svg')}}" alt=""></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.ent-href').mouseover(function () {
                $(this).parent().parent().parent().find('.ent-href').css({
                    "color": "#c11800",
                });
            });
            $('.ent-href').mouseout(function () {
                $(this).parent().parent().parent().find('.ent-href').css({
                    "color": "black",
                });
            });
            $('.pagination-block button').mouseover(function () {
                if(this.id == 'nextPage'){
                    $('img', this).attr('src', "{{asset('img/pagination-right-red.svg')}}");
                }
                else {
                    $('img', this).attr('src', "{{asset('img/pagination-left-red.svg')}}");
                }
            });
            $('.pagination-block button').mouseout(function () {
                if(this.id == 'nextPage'){
                    $('img', this).attr('src', "{{asset('img/pagination-right.svg')}}");
                }
                else {
                    $('img', this).attr('src', "{{asset('img/pagination-left.svg')}}");
                }
            });
        });
        jQuery(function () {
            jQuery("#pagination-select2").change(function () {
                location.href = jQuery(this).val();
            });
        })
    </script>
@endsection