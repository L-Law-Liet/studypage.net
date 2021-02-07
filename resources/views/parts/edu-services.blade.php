
<div class="mb-md-4 mb-1 pb-1">
    <p style="color: #2D7ABF; font-size: 18px">ОБРАЗОВАТЕЛЬНЫЕ СЕРВИСЫ</p>
    <div class="d-flex justify-content-between flex-md-row flex-column mb-2">
        <div class="p-3 text-light teaser-rebrush clearfix mr-1 find-form">
            <h2 class="text-light pt-3">Найдите специальность и учебное заведение</h2>

            <form id="stForm" method="GET" action="/poisk">
                <fieldset>
                    <div class="form-group m-b-0 position-relative">
                        <label class="col-form-label"><i class="fas fa-graduation-cap"></i> Степень</label>
                        <select required id="st" name="degree_id" class="form-control degreec">
                            <option value="">Выберите</option>
                            @foreach($degrees as $d)
                                <option value="{{ $d->id }}">{{ $d->name_ru }}</option>
                            @endforeach
                        </select>
                        <button id="Zearch" type="submit" hidden></button>
                    </div>
                    <div class="form-group m-b-0">
                        <label class="col-form-label"><i class="fas fa-atlas"></i> Форма обучения</label>
                        <select id="dr" name="direction_id" class="form-control directionc">
                            <option value="0">Выберите</option>
                            @foreach(\App\EducationForm::all() as $e)
                                <option value="{{$e->id}}">{{$e->name}}</option>
                            @endforeach
                            {{--                                    @foreach($directions as $k => $v)--}}
                            {{--                                        <option data-url="{{ $v->url }}" value="{{ $v->id }}">{{ $v->name_ru }}</option>--}}
                            {{--                                    @endforeach--}}
                        </select>
                    </div>
                    <div class="form-group nnA">
                        <label class="col-form-label"><i class="fas fa-globe-americas"></i> Регион</label>
                        <select id="ct" name="city_id" class="form-control cityc">
                            <option value="0">Выберите</option>
                            @foreach($cities as $k => $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>
                <div class="form-group oG">
                    <p class="m-t-18" style="text-align: right;">Доступно <span class="cc">{{ number_format($cost_count, 0, "", " ") }}</span> специальностей</p>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary-custom goSearch">
                        {{ trans('general.search') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="slider-lists-div mt-4" style="height: 233px">
            <div class="slider-lists">
                <div>
                    <div class="d-table three-tables mb-0"
                         style="width: 100%; height: 217px;
                                 background: url({{asset('img/social/'.\App\Models\Social::find(13)->link)}}) no-repeat center;
                                 background-size: cover;">
                        <div onclick="window.location='{{url('navigator/list/college')}}'"
                             class="align-middle d-table-cell text-center text-white"
                             style="font-size: 20px">СТРАНИЦА КОЛЛЕДЖЕЙ</div>
                    </div>
                </div>
                <div>
                    <div onclick="window.location='{{url('navigator/list/universities')}}'"
                         style="width: 100%; height: 217px;
                                 background: url({{asset('img/social/'.\App\Models\Social::find(14)->link)}}) no-repeat center;
                                 background-size: cover;"
                         class="clickable-el d-table three-tables mb-0">
                        <div class="p-3 align-middle d-table-cell text-center text-white"
                             style="font-size: 20px">СТРАНИЦА ВУЗОВ</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-ent-faq row">
            <div class="col-12">
                <div onclick="window.location='{{url('qazaqstan/calculator-ent')}}'" class="m-ent-calc d-table" style="
                        width: 100%; height: 100%;
                        background: url({{asset('img/social/'.\App\Models\Social::find(11)->link)}}) no-repeat; background-size: cover;">
                    <div class="align-middle d-table-cell text-center text-white text-in-table"
                         style="font-size: 20px">КАЛЬКУЛЯТОР ЕНТ</div>
                </div>
            </div>
            <div class="col-12">
                <div onclick="window.location='{{url('navigator/faq/1')}}'"
                     style="width: 100%; height: 100%;
                             background: url({{asset('img/social/'.\App\Models\Social::find(15)->link)}}) no-repeat center;
                             background-size: cover;"
                     class="clickable-el d-table three-tables">
                    <div class="align-middle d-table-cell text-center text-white pr-4 pl-4"
                    style="font-size: 20px">ВОПРОСЫ И ОТВЕТЫ В СФЕРЕ ОБРАЗОВАНИЯ</div>
                </div>
            </div>
        </div>

        <div class="row mr-0 ml-2 edu-service-blocks">
            <div class="col-md-6 h-50" style="padding: 0 .5rem .5rem 0;">
                <div class="clickable-el d-table three-tables"
                     style="width: 100%; height: 100%;
                             background: url({{asset('img/social/'.\App\Models\Social::find(13)->link)}}) no-repeat center;
                             background-size: cover">
                    <div onclick="window.location='{{url('navigator/list/college')}}'"
                         class="align-middle d-table-cell text-center text-white"
                         style="font-size: 20px">СТРАНИЦА КОЛЛЕДЖЕЙ</div>
                </div>
            </div>
            <div class="col-md-6 h-50" style="padding: 0 0 .5rem .5rem;">
                <div onclick="window.location='{{url('navigator/list/universities')}}'"
                     style="width: 100%; height: 100%;
                             background: url({{asset('img/social/'.\App\Models\Social::find(14)->link)}}) no-repeat center;
                             background-size: cover"
                     class="clickable-el d-table three-tables">
                    <div class="p-3 align-middle d-table-cell text-center text-white"
                         style="font-size: 20px">СТРАНИЦА ВУЗОВ</div>
                </div>
            </div>
            <div class="col-md-6 h-50" style="padding: .5rem .5rem 0 0;">
                <div onclick="window.location='{{url('qazaqstan/calculator-ent')}}'" class="clickable-el m-ent-calc d-table" style="
                        width: 100%; height: 100%;
                        background: url({{asset('img/social/'.\App\Models\Social::find(11)->link)}}) no-repeat; background-size: cover;">
                    <div class="align-middle d-table-cell text-center text-white text-in-table"
                         style="font-size: 20px">КАЛЬКУЛЯТОР ЕНТ</div>
                </div>
            </div>
            <div class="col-md-6 h-50" style="padding: .5rem 0 0 .5rem;">
                <div onclick="window.location='{{url('navigator/faq/1')}}'"
                     style="width: 100%; height: 100%;
                             background: url({{asset('img/social/'.\App\Models\Social::find(15)->link)}}) no-repeat center;
                             background-size: cover"
                     class="clickable-el d-table three-tables">
                    <div class="align-middle d-table-cell text-center text-white pr-4 pl-4"
                         style="font-size: 20px">ВОПРОСЫ И ОТВЕТЫ В СФЕРЕ ОБРАЗОВАНИЯ</div>
                </div>
            </div>
        </div>
    </div>
</div>