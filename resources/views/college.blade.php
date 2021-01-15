@extends('layouts.app')
@section('title')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4 left-block">
                <div class="form-group">
                    <label>Образовательная программа</label>
                    <select class="form-control" name="program">
                        <option value="matem">Математика</option>
                        <option value="cs">Информатика</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Поступление в колледж</label>
                    <select class="form-control" name="when">
                        <option value="after9">После 9 класса</option>
                        <option value="afterSchool">После школы</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Форма обучения</label>
                    <select class="form-control" name="studyForm">
                        <option value="ochnaya">Очная(дневная)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Стоимость обучения</label>
                    <div class="d-flex justify-content-between">
                        <input class="form-control w-50 mr-2 p-2 " type="text" placeholder="от">
                        <input class="form-control w-50 ml-3 p-2 " type="text" placeholder="до">
                    </div>
                </div>

                <div class="form-group">
                    <label>Регион</label>
                    <select class="form-control" name="region">
                        <option value="almaty">Алматы</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Колледж</label>
                    <select class="form-control" name="college">
                        <option value="narhoz">Университет Нархоз</option>
                    </select>
                </div>
            </div>

            <div class="col-md-8 right-block result">
                <div class="sgs-list-header clearfix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <p class="pull-left">Результат: найдено специальностей <span class="count">{{count($costs)}}</span></p>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3">
                            <form class="form-horizontal sgs-list-sort" role="form">
                                <div class="form-group m-b-0">
                                    <select class="form-control sgs-sort" id="sortorder" name="sort">
                                        <option selected disabled value="default">Сортировка по</option>
                                        <option value="name">Наименование</option>
                                        <option value="town">Город</option>
                                        <option value="cost">Стоимость</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="sgs-list-ul">
                        @php
                            $pageSize = 10+$page*10;
                            if ($pageSize >  count($costs))
                                $pageSize = count($costs);
                        @endphp
                        @for($i = $page*10; $i < $pageSize; $i++)
                        <li>
                                <div style="margin-bottom: 30px;">
                                    <h3>
                                        <a href="{{url('/college/view', [$costs[$i]->relSpecialty->id, 'uid', $costs[$i]->relUniversity->id])}}">
                                            <strong>{{$costs[$i]->relSpecialty->name_ru}}</strong>
                                            <span>{{$costs[$i]->relUniversity->name_ru}}</span> • {{$costs[$i]->relUniversity->relCity->name_ru}}
                                        </a>
                                    </h3>
                                    <table>
                                        <tbody class="main-table">
                                        <tr>
                                            <td>Квалификация</td>
                                            <td>{{$costs[$i]->relSpecialty->relDegree->name_ru}}</td>
                                        </tr>
                                        <tr>
                                            <td>Стоимость обучения</td>
                                            <td>{{$costs[$i]->price}} тг. / год</td>
                                        </tr>

                                        <tr>
                                            <td>Поступление в колледж</td>
                                            <td>{{$costs[$i]->income}}</td>
                                        </tr>
                                        <tr>
                                            <td>Срок обучения</td>
                                            <td>{{$costs[$i]->relSpecialty->education_time}}</td>
                                        </tr>
                                        <tr>
                                            <td>Форма обучения</td>
                                            <td>{{$costs[$i]->education_form}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            @endfor
                    </ul>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div class="pagination-block m-2 p-2">
                    <div class="row m-1">
                        <div @if($page > 0) onclick="window.location='{{url('college', ($page-1))}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img src="{{asset('img/pagination-left.svg')}}" alt=""></div>
                        <div class="col-10 text-center form-group position-relative">
                            <div id="select-div">
                                <select id="pagination-select" class="custom-control-inline border-0 m-0" style="outline: 0" onchange="javascript:location.href = this.value;">
                                    @for($i = 0; $i < ceil(count($costs)/10); $i++)
                                        @if($i == $page)
                                            <option value="{{$i+1}}" selected>{{(1+$page)}} из {{ceil(count($costs)/10)}}</option>
                                        @else
                                            <option class="nPage" value="{{url('college', $i)}}">Страница {{$i+1}}</option>
                                        @endif
                                    @endfor
                                </select>
{{--                                <img id="img-page" src="{{asset('img/pagination-down.svg')}}" alt="">--}}
                            </div>
                        </div>
                        <div @if($page < ceil(count($costs)/10)-1) onclick="window.location='{{url('college', ($page+1))}}'" style="cursor: pointer" @else disabled @endif class="col-1 text-center"><img src="{{asset('img/pagination-right.svg')}}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            // $('#select-div').mouseup(function () {
            //     var size = $('#pagination-select option').size();
            //     if(size!=$("#pagination-select").prop('size'))
            //     {
            //         console.log('L:', size);
            //         $("#pagination-select").prop('size',size);
            //     }
            //     else
            //     {
            //
            //         console.log('N:', size);
            //         $("#pagination-select").prop('size',1);
            //     }
            //
            // });
            jQuery("#pagination-select").change(function () {
                location.href = jQuery(this).val();
            });
        })
    </script>
@endsection
