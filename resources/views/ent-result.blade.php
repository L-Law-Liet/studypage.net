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
            <div class="pc">
                <table id="ent-table">
                    <thead>
                    <tr>
                        <td colspan="3" class="ent-td w-75 p-2" >Шансы поступить на грант</td>
                        <td @if(count($sRes[3]) > 0) onclick="window.location='{{route('result-ent2', [4, encrypt($score), $profs[0], $profs[1], $lang])}}'" @endif class="ent-td w-25 not-33 align-middle @if(count($sRes[3]) > 0) red-hover clickable-el @endif" rowspan="2">Шансы поступить на платное ({{count($sRes[3])}})</td>
                    </tr>
                    <tr>
                        <td @if(count($sRes[0]) > 0) onclick="window.location='{{route('result-ent2', [1, encrypt($score), $profs[0], $profs[1], $lang])}}'" @endif class="ent-td @if(count($sRes[0]) > 0)  red-hover clickable-el @endif">Высокий ({{count($sRes[0])}})</td>
                        <td @if(count($sRes[1]) > 0) onclick="window.location='{{route('result-ent2', [2, encrypt($score),  $profs[0], $profs[1], $lang])}}'" @endif class="ent-td @if(count($sRes[1]) > 0) red-hover clickable-el @endif">Средний ({{count($sRes[1])}})</td>
                        <td @if(count($sRes[2]) > 0) onclick="window.location='{{route('result-ent2', [3, encrypt($score), $profs[0], $profs[1], $lang])}}'" @endif class="ent-td @if(count($sRes[2]) > 0) red-hover clickable-el @endif">Низкий ({{count($sRes[2])}})</td>
                    </tr>
                    </thead>
                    <tbody class="ent-tbody">
{{--                    <tr>--}}
{{--                        <td>“Равно” или “больше” проходного балла на грант</td>--}}
{{--                        <td>“Меньше с 1 по 5 баллов” чем Проходной балл ЕНТ на грант (5)</td>--}}
{{--                        <td>“Меньше с 6 по 13 баллов” чем Проходной балл ЕНТ на грант (10)</td>--}}
{{--                        <td class=" not-33">“Меньше с 14 баллов” чем Проходной балл ЕНТ на грант, но не меньше проходного балла на платное</td>--}}
{{--                    </tr>--}}
@for($i = 0; $i < 5; $i++)
                    <tr>
                        <td>
                            @if(count($sRes[0]) > $i)
                             <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                 <div>
                                     <b>
                                         <a class="ent-href" href="{{route('resToSearch', [$sRes[0][$i]->relSpecialty->learn_program_group_id, $sRes[0][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[0][$i]->relSpecialty->lpg->name_ru}}</a>
                                     </b>
                                 </div>
                            </div>
                                <div class="d-flex justify-content-start">
                                    <div class="w-8"><i class="fas fa-building"></i></div>
                                    <p class="mb-0">
                                        <span>
                                        <a class="ent-href" href="{{route('resToSearch', [$sRes[0][$i]->relSpecialty->learn_program_group_id, $sRes[0][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[0][$i]->relUniversity->name_ru}}</a>
                                        </span>
                                    </p>
                                </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл ЕНТ: {{($lang == 1)?$sRes[0][$i]->passing_score_kz:$sRes[0][$i]->passing_score_ru}}</b></div>
                                    </div>
                                @endif
                        </td>
                        <td>
                            @if(count($sRes[1]) > $i)
                              <div class="justify-content-start d-flex">
                                  <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                  <div>
                                      <b>
                                          <a class="ent-href" href="{{route('resToSearch', [$sRes[1][$i]->relSpecialty->learn_program_group_id, $sRes[1][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[1][$i]->relSpecialty->lpg->name_ru}}</a>
                                      </b>
                                  </div>
                              </div>
                              <div class="d-flex justify-content-start">
                                  <div class="w-8"><i class="fas fa-building"></i></div>
                                  <p class="mb-0">
                                      <span>
                                        <a class="ent-href" href="{{route('resToSearch', [$sRes[1][$i]->relSpecialty->learn_program_group_id, $sRes[1][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[1][$i]->relUniversity->name_ru}}</a>
                                      </span>
                                  </p>
                              </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл ЕНТ: {{($lang == 1)?$sRes[1][$i]->passing_score_kz:$sRes[1][$i]->passing_score_ru}}</b></div>
                                    </div>
                            @endif
                        </td>
                        <td>
                            @if(count($sRes[2]) > $i)
                            <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                <div>
                                    <b><a class="ent-href" href="{{route('resToSearch', [$sRes[2][$i]->relSpecialty->learn_program_group_id, $sRes[2][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[2][$i]->relSpecialty->lpg->name_ru}}</a></b>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="w-8"><i class="fas fa-building"></i></div>
                                <p class="mb-0">
                                    <span>
                                        <a class="ent-href" href="{{route('resToSearch', [$sRes[2][$i]->relSpecialty->learn_program_group_id, $sRes[2][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[2][$i]->relUniversity->name_ru}}</a>
                                    </span>
                                </p>
                            </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div>
                                            <b>Проходной балл ЕНТ: {{($lang == 1)?$sRes[2][$i]->passing_score_kz:$sRes[2][$i]->passing_score_ru}}</b>
                                        </div>
                                    </div>
                            @endif
                        </td>
                        <td class=" not-33">
                            @if(count($sRes[3]) > $i)
                             <div class="justify-content-start d-flex">
                                <div class="w-8"><i class="fas fa-graduation-cap"></i></div>
                                 <div>
                                     <b><a class="ent-href" href="{{route('resToSearch', [$sRes[3][$i]->relSpecialty->learn_program_group_id, $sRes[3][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[3][$i]->relSpecialty->lpg->name_ru}}</a></b>
                                 </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div class="w-8"><i class="fas fa-building"></i></div>
                                <p class="mb-0">
                                    <span><a class="ent-href" href="{{route('resToSearch', [$sRes[3][$i]->relSpecialty->learn_program_group_id, $sRes[3][$i]->university_id, $profs[0], $profs[1]])}}">{{$sRes[3][$i]->relUniversity->name_ru}}</a></span>
                                </p>
                            </div>
                                    <div class="d-flex justify-content-start">
                                        <div class="w-8"></div>
                                        <div><b>Проходной балл на платное: {{$sRes[3][$i]->paid_score}}</b></div>
                                    </div>
                            @endif
                        </td>
                    </tr>
@endfor
                    </tbody>
                </table>
            </div>
            <div class="mobile">
                <div class="row">
                    <div class="col-7 p-1">
                        <div class="ent-td h-100">Шансы поступить на грант</div>
                    </div>
                    <div class="col-5 p-1">
                        <div onclick="window.location='{{route('result-ent2', [1, encrypt($score), $profs[0], $profs[1], $lang])}}'" class="ent-td clickable-el mb-1">Высокий ({{count($sRes[0])}})</div>
                        <div onclick="window.location='{{route('result-ent2', [2, encrypt($score),  $profs[0], $profs[1], $lang])}}'" class="ent-td clickable-el mb-1">Средний ({{count($sRes[1])}})</div>
                        <div onclick="window.location='{{route('result-ent2', [3, encrypt($score), $profs[0], $profs[1], $lang])}}'" class="ent-td clickable-el">Низкий ({{count($sRes[2])}})</div>
                    </div>
                    <div class="col-12 p-1">
                        <div onclick="window.location='{{route('result-ent2', [4, encrypt($score), $profs[0], $profs[1], $lang])}}'" class="ent-td clickable-el">Шансы поступить на платное ({{count($sRes[3])}})</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.ent-href').mouseover(function () {
                $(this).parent().parent().parent().parent().find('.ent-href').css({
                    "color": "#c11800",
                });
            });
            $('.ent-href').mouseout(function () {
                $(this).parent().parent().parent().parent().find('.ent-href').css({
                    "color": "black",
                });
            });
        });
    </script>
@endsection