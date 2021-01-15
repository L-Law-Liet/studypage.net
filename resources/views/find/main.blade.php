@extends('layouts.app')

@section('content')
    <div id="erF">
        <div class="erFblock">Количество профильных предметов не более 2</div>
    </div>
    <div class="nPreloader">
        <img src="/img/preloader.gif">
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-4 left-block">
               <!--<div class="form-group">

                    <label for="degree">Поиск</label>
                    <input id="rsearch" type="text" value="<?=$search?>" name="search" class="form-control" placeholder="Поиск">
                </div>-->
                    <input id="rsearch" type="hidden" value="<?=$search?>" name="search" class="form-control" placeholder="Поиск">

                    <div class="form-group">

                    <label for="degree">Степень обучения</label>
                    <select name="degree_id" class="form-control degree" id="degree_id">
                        <option value="any">Выберите</option>
                        @foreach($degrees as $k => $v)
                            <option @if(!is_null($degree_id) && $degree_id == $v->url) selected @endif value="<?=$v->url?>"><?=$v->name_ru?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="direction_id">Область образования</label>
                    <select name="direction_id" class="form-control direction" id="direction_id">
                        <option value="any">Выберите</option>
                        @foreach($directions as $k => $v)
                            <option @if(!is_null($direction_id) && $direction_id == $v->url) selected @endif value="<?=$v->url?>"><?=$v->name_ru?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="subdirection" @if($subdirections != null) style="display: block;" @else style="display: none;" @endif>
                    <label for="subdirection_id">Направление подготовки</label>
                    <select name="subdirection_id" class="form-control subdirection" id="subdirection_id">
                        <option value="any">Выберите</option>
                        <? if (!empty($subdirections) AND $subdirections != null) { ?>
                            @foreach($subdirections as $k => $v)
                                <option @if(!is_null($subdirection_id) && $subdirection_id == $v->url) selected @endif value="<?=$v->url?>"><?=$v->name_ru?></option>
                            @endforeach
                        <? } ?>
                    </select>
                </div>
                <div class="form-group" id="specialty" @if(!empty($spec) AND $spec != null) style="display: block;" @else style="display: none;" @endif>
                    <label for="specialty_id">Специальность</label>
                    <select name="specialty_id" class="form-control specialty" id="specialty_id">
                        <option value="any">Выберите</option>
                        <? if (!empty($spec) AND $spec != null) { ?>
                        <? $mass = array(); ?>
                        @foreach($spec as $k => $v)
                            <? if (!in_array($v->name_ru, $mass)) { ?>
                                <option @if(!is_null($specialty_id) && $specialty_id == $v->url) selected @endif value="<?=$v->url?>"><?=$v->name_ru?></option>
                                <? $mass[] = $v->name_ru; ?>
                            <? } ?>
                        @endforeach
                        <? } ?>
                    </select>
                </div>
                <div class="form-group discipline" @if($degree_id == 'bakalavriat' || is_null($degree_id)) style="display: block;"
                        @else style="display: none;" @endif>
                    <label for="discipline">Профильный предмет</label>
                    <?php
                        $pr1 = -1;
                        $pr2 = -1;
                        if (!empty($_GET['pr1'])) {
                            $pr1 = $_GET['pr1'];
                        }
                        if (!empty($_GET['pr2'])) {
                            $pr2 = $_GET['pr2'];
                        }
                    ?>
                    @foreach($subjects as $k => $v)
                        <div class="checkbox">
                            <label><input class="subject" <? if ($k == $pr1 OR $k == $pr2) { ?>checked<? } ?> name="subject_id" id="subject_id" type="checkbox" value="{{ $k }}"> {{ $v }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="city_id">Город</label>
                    <select name="city_id" class="form-control city" id="city_id">
                        <option value="any">Выберите</option>
                        @foreach($cities as $k => $v)
                            <option @if(!is_null($city_id) && $city_id == $k) selected @endif value="<?=$k?>"><?=$v?></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="un_id">ВУЗ</label>
                    <select name="un_id" class="form-control un" id="un_id">
                        <option value="">Выберите</option>
                        @foreach($u as $k => $v)
                            <option @if(!is_null($un_id) && $un_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div @if($degree_id == 'bakalavriat' || is_null($degree_id)) style="display: none;"
                     @else style="display: block;" @endif class="form-group sphere">
                    <label>Сфера направления</label>
                    <select name="program_id" class="form-control program" id="program_id">
                        <option value="">Выберите</option>
                        @foreach($programs as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Тип учебного заведения</label>
                    <select name="type_id" class="form-control type" id="type_id">
                        <option value="">Выберите</option>
                        @foreach($types as $k => $v)
                            <option @if(!is_null($type_id) && $type_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-8 right-block result">
                <div class="sgs-list-header clearfix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <p class="pull-left">Результат: найдено специальностей <span class="count">{{ $count }}</span></p>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3">
                            <form class="form-horizontal sgs-list-sort" role="form">
                                <div class="form-group m-b-0">
                                    <label for="sortorder" class="sr-only">Сортировать по:</label>
                                    <select class="form-control sgs-sort" id="sortorder" name="sort">
                                        <option <? if ($sort == 'name') { ?>selected<? } ?> value="name">Наименование</option>
                                        <option <? if ($sort == 'town') { ?>selected<? } ?> value="town">Город</option>
                                        <option <? if ($sort == 'cost') { ?>selected<? } ?> value="cost">Стоимость</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="sgs-list-ul">
                        @foreach($specialties as $k => $v)
                            <li>
                                <div style="margin-bottom: 30px;">
                                    <h3>
                                        <a href="/poisk/view/{{ $v->id }}">
                                            <strong><? if ($v->relSpecialty->cipher != null AND $v->relSpecialty->cipher != 'none') { ?>{{$v->relSpecialty->cipher }} • <? } ?>{{$v->relSpecialty->name_ru }}</strong>
                                            <span>{{ $v->relUniversity->name_ru }}</span> • {{$v->relUniversity->relCity->name_ru }}
                                        </a>
                                    </h3>
                                    <table>
                                        <tbody class="main-table">
                                            <tr>
                                                <td>Степень обучения</td>
                                                <td>{{ $v->relSpecialty->relDegree->name_ru }}</td>
                                            </tr>
                                            <tr>
                                                <td>Стоимость обучения</td>
                                                <td>{{ number_format($v->price, 0, '', ' ') }} тг. @if($v->price != 0)/ год @endif</td>
                                            </tr>
                                            @if(($degree_id == 'bakalavriat' || !isset($degree_id)) && is_object($v->relSpecialty->relSubject) && is_object($v->relSpecialty->relSubject2)) {{--Бакалавр--}}
                                                <tr>
                                                    <td>Профильный предмет</td>
                                                    <td>{{ $v->relSpecialty->relSubject->name_ru }}, {{ $v->relSpecialty->relSubject2->name_ru }}</td>
                                                </tr>
                                            @endif
                                            @if((in_array($degree_id, ['magistratura', 'doktorantura']) || !isset($degree_id)) && !empty($v->relSpecialty->relSphere)) {{--Машистратура--}}
                                                <tr>
                                                    <td>Сфера направления</td>
                                                    <td>{{ $v->relSpecialty->relSphere->name_ru }}</td>
                                                </tr>
                                            @endif
                                            <!--<tr>
                                                <td>Рейтинг специальности</td>
                                                <td>@if(!empty($v->rating)){{ $v->rating }} место @else - @endif</td>
                                            </tr>-->
                                            <tr>
                                                <td>Срок обучения</td>
                                                <td>{{ $v->relSpecialty->education_time }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="ajax-pagination">
                        {{ $specialties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="/css/chosen.min.css" rel="stylesheet" type="text/css">
    <script src="/js/chosen.jquery.min.js"></script>
    <script>
			$('.degree').chosen();
			$('.direction').chosen();
			$('.subdirection').chosen();
            $('.specialty').chosen();
            $('.city').chosen();
            $('.un').chosen();
            $('.program').chosen();
            $('.type').chosen();
    </script>
@endsection
