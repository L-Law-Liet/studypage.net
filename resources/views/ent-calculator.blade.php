@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')
    @if(session('m'))

        <div id="Message" class="message">

            <!-- Modal content -->
            <div class="modal-content">
                <div>
                    <img class="close1" src="{{asset('img/login_form_close.svg')}}" alt="">
                </div>
                <p class="text-center">{{session('m')}}</p>

                <div class="dialog-button-div mt-2 pt-1 mb-2">
                    <button id="logged1" class="border-0 p-2">Пополнить счет</button>
                </div>
            </div>

        </div>
        @elseif(session('m1'))
        <div id="Message" class="message">

            <!-- Modal content -->
            <div class="modal-content">
                <div>
                    <img class="close1" src="{{asset('img/login_form_close.svg')}}" alt="">
                </div>
                <h5 class="text-center m-3">{{session('m1')}}</h5>

                <div class="dialog-button-div m-4">
                    <button onclick="redirectToLogin()" class="border-0 p-2">Войти</button>
                </div>
            </div>

        </div>

        @endif
    <div class="container">
                <div id="college-view-right">
                    <div>
                        <h3 class="text-center">КАЛЬКУЛЯТОР ЕНТ: УЗНАЙТЕ КАКИЕ У ВАС ШАНСЫ ПОСТУПИТЬ</h3>
                        <p class="text-center ent-subtitle m-2">
                            Укажите предметы и баллы ЕНТ и узнайте на какие группы образовательных программ
                            ВУЗов Ваши шансы поступить выше. Если баллы каких-то предметов не известны,
                            попробуйте смоделировать их.
                        </p>
                    </div>
                    <form action="{{action('PagesController@entResult')}}" method="post">
                        @csrf
                        <div class="row mt-5 mobile-ent">
                            <div class="row col-md-6 mobile-pr-0 col-xs-12">
                                <div class=" col-md-6 mobile-pr-0 col-xs-12">
                                    <label>Выберите язык обучения</label>
                                </div>
                                <div class="col-md-6 mobile-pr-0 col-xs-12">
                                    <div class="form-group">
                                        <div>
                                            <select id="lang-pc" required class="form-control chsn" name="lang">
                                                <option value="">Выберите</option>
                                                <option value="1">Казахский</option>
                                                <option value="2">Русский</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 mobile-pr-0 col-xs-12">
                                    <div class="form-group">
                                        <div class="pc">
                                            <select id="ent-calc-1prof" required class="form-control sgs-sort sortorder chosen" name="1profSelect">
                                                <option id="first" value="">1-й профильный предмет</option>
                                                @foreach($ss as $s)
                                                    <option id="fid{{$s->id}}" value="{{$s->id}}">{{$s->name_ru}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mobile">
                                            <select id="ent-calc-1prof-mobile" required class="form-control sgs-sort sortorder" name="1profSelect">
                                                <option id="first" value="">1-й профильный предмет</option>
                                                @foreach($ss as $s)
                                                    <option id="fmid{{$s->id}}" value="{{$s->id}}">{{$s->name_ru}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pc">
                                            <select id="ent-calc-2prof" required class="form-control sgs-sort sortorder chosen" name="2profSelect">
                                                <option id="second" value="">2-й профильный предмет</option>
                                                @foreach($ss as $s)
                                                    <option id="sid{{$s->id}}" value="{{$s->id}}">{{$s->name_ru}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mobile-pr-0 col-xs-12">
                                    <div class="form-group">
                                        <input onkeypress='validate(event)' required oninput="max40(event)" class="form-control sgs-sort" placeholder="Балл" type="number" max="40" min="0" name="1profPoint">
                                    </div>
                                    <div class="form-group">
                                        <div class="mobile">
                                            <select id="ent-calc-2prof-mobile" required class="form-control sgs-sort sortorder" name="2profSelect">
                                                <option id="second" value="">2-й профильный предмет</option>
                                                @foreach($ss as $s)
                                                    <option id="smid{{$s->id}}" value="{{$s->id}}">{{$s->name_ru}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input onkeypress='validate(event)' required oninput="max40(event)" class="form-control sgs-sort" placeholder="Балл" type="number" max="40" min="0" name="2profPoint">
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-xs-12 mobile-ent-div">
                                <div class="form-group d-flex flex-md-row flex-column justify-content-between">
                                    <label class="w-50">Математическая грамотность</label>
                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="matGr" id="matGr">
                                </div>
                                <div class="form-group d-flex flex-md-row flex-column  justify-content-between">
                                    <label class="w-50">Грамотность чтения</label>

                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="readGr">
                                </div>
                                <div class="form-group d-flex flex-md-row flex-column  justify-content-between">
                                    <label class="w-50">История Казахстана</label>
                                    <input onkeypress='validate(event)' required oninput="max20(event)" class="form-control sgs-sort w-50" placeholder="Балл" type="number" max="20" min="0" name="historyKZ">
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-4 p-1 mobile-ent-button">
                            <input type="text" hidden name="access" value="1">
                            <div class="clearfix">
                                <div class="mt-3 m-md-auto mb-1">
                                    <button type="submit" style="text-transform: none; font-size: 1.2rem" class="btn col-md-4 col-xs-12 btn-primary-custom">
                                        Узнать шансы
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
    <script>
        $(".chosen").chosen().on('change', function(evt, params) {
            if (params.selected !== undefined) {
                $(this).find('option:selected').map(function() {
                    $(".mobile select").prop('required', false);
                    $("#ent-calc-2prof-mobile").prop('value', $("#ent-calc-2prof").prop("value"));
                    $("#ent-calc-1prof-mobile").prop('value', $("#ent-calc-1prof").prop("value"));
                    $("#lang-mob").prop('value', $("#lang-pc").prop("value"));
                    if($(this).attr('value') == ''){
                        if($(this).prop('id') == 'first'){
                            $('#ent-calc-2prof option').show().trigger("chosen:updated");
                        }
                        else {
                            $('#ent-calc-1prof option').show().trigger("chosen:updated");
                        }
                    }
                    if ($(this).attr('value') == params.selected) {
                        let L = $(this).prop('value');
                        if($(this).prop('id')[0] == 'f'){
                            $('#ent-calc-2prof option').show();
                            if($(this).text() != 'Творческий')
                            $('#sid' + L).hide();
                        }
                        else {
                            $('#ent-calc-1prof option').show();
                            if($(this).text() != 'Творческий')
                            $('#fid' + L).hide();
                        }

                        $(".chosen").trigger("chosen:updated");
                    }
                });
             }
        });
        $("#ent-calc-1prof-mobile").on('change', function () {
            $("#ent-calc-2prof-mobile option").prop('disabled', false);
            if($("#smid"+$("#ent-calc-1prof-mobile").prop("value")).text() != 'Творческий')
                $("#smid"+$("#ent-calc-1prof-mobile").prop("value")).prop('disabled', true);
            $(".pc select").prop('required', false);
            $("#ent-calc-2prof").prop('value', $("#ent-calc-2prof-mobile").prop("value"));
            $("#ent-calc-1prof").prop('value', $("#ent-calc-1prof-mobile").prop("value"));
            $("#lang-pc").prop('value', $("#lang-mob").prop("value"));
        });
        $("#ent-calc-2prof-mobile").on('change', function () {
            $("#ent-calc-1prof-mobile option").prop('disabled', false);
            if($("#fmid"+$("#ent-calc-2prof-mobile").prop("value")).text() != 'Творческий')
                $("#fmid"+$("#ent-calc-2prof-mobile").prop("value")).prop('disabled', true);
            $(".pc select").prop('required', false);
            $("#ent-calc-2prof").prop('value', $("#ent-calc-2prof-mobile").prop("value"));
            $("#ent-calc-1prof").prop('value', $("#ent-calc-1prof-mobile").prop("value"));
            $("#lang-pc").prop('value', $("#lang-mob").prop("value"));
        });
        function max20(event) {
            if(event.target.value > 20){
                event.target.value = 20;
            }
            if(event.target.value < 0){
                event.target.value = 0;
            }
        }
        function max40(event) {
            if(event.target.value > 40){
                event.target.value = 40;
            }
            if(event.target.value < 0){
                event.target.value = 0;
            }
        }
        // Get the modal
        var modal1 = document.getElementById("Message");

        // Get the <span> element that closes the modal
        var span1 = document.getElementsByClassName("close1")[0];

        // When the user clicks on <span> (x), close the modal
        span1.onclick = function() {
            modal1.style.display = "none";
        }
        $('#logged1').on('click', function () {
            modal1.style.display = "none";
            $('#logged').click();
        });

        setTimeout(fade_out, 3500);
        function fade_out() {
            $("#messagError").fadeOut().empty();
        }
    </script>
@endsection
