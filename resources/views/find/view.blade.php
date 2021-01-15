@extends('layouts.app')

@section('content')

<div class="container">
    <div class="studiengangsuche sgs-detail" id="studiengangsuche">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p class="back-link">
                    <a href="{{ url()->previous() }}"><span class="sprites back"></span>Вернуться к результатам поиска</a>
                </p>
                <div class="sgs-adress-header">
                    <h2>
                        <div>
                            <? if ($specialty->relSpecialty->cipher != null AND $specialty->relSpecialty->cipher != 'none') { ?><span class="sgs-rod">{{ $specialty->relSpecialty->cipher }}</span><? } ?> <span class="sgs-rod"><? if ($specialty->relSpecialty->cipher != null AND $specialty->relSpecialty->cipher != 'none') { ?>•<? } ?>{{ $specialty->relSpecialty->name_ru }}</span>
                        </div>
                        <div>
                            <span class="sgs-rod">{{ $specialty->relUniversity->name_ru }}</span>
                            <span class="sgs-rod">•{{ $specialty->relUniversity->relCity->name_ru }}</span>
                        </div>
                    </h2>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a class="active" data-toggle="tab" href="#overview" role="tab" id="ui-tab-1" tabindex="0" aria-selected="true" aria-controls="overview">Обзор</a>
                    </li>
                    @if(!empty($specialty->passing_score_kz) || !empty($specialty->number_grants_kz) || !empty($specialty->passing_score_ru) || !empty($specialty->number_grants_ru) || !empty($specialty->passing_score))
                        <li role="presentation" class=""><a data-toggle="tab" href="#grant" role="tab" id="ui-tab-2" tabindex="-1" aria-selected="false" aria-controls="grant">Грант</a>
                        </li>
                    @endif
                    @php $rating = \App\Models\CostEducation::getRating($specialty->relSpecialty->id) @endphp

                    @if(count($rating) > 0)
                        <li role="presentation" class=""><a data-toggle="tab" href="#rating" role="tab" id="ui-tab-3" tabindex="-1" aria-selected="false" aria-controls="rating">Рейтинг</a>
                        </li>
                    @endif
                    <li role="presentation" class=""><a data-toggle="tab" href="#doc" role="tab" id="ui-tab-4" tabindex="-1" aria-selected="false" aria-controls="doc">Документ</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div class="tab-content">
                    <div id="overview" class="tab-pane fade active in" role="tabpanel" tabindex="0" aria-hidden="false" aria-labelledby="ui-tab-1">
                        <? if (!empty($specialty->relLanguage->name_ru)) {?>
                        <h3>Язык обучения</h3>
                        <p>{{ $specialty->relLanguage->name_ru }}</p>
                        <? } ?>
                        @if(!empty($specialty->relSpecialty->education_time))
                            <h3>Срок обучения</h3>
                            <p>{{ $specialty->relSpecialty->education_time }}</p>
                        @endif
                        <h3>Степень обучения</h3>
                        <p>{{ $specialty->relSpecialty->relDegree->name_ru }}</p>
                        <h3>Стоимость обучения</h3>
                        <p>{{ number_format($specialty->price, 0, '', ' ') }} тенге @if($specialty->price != 0)/ год @endif</p>

                        @if($specialty->relSpecialty->relDegree->id == 1)
                            <h3>Профильный предмет</h3>
                            <p>{{ $specialty->relSpecialty->relSubject->name_ru }}, {{ $specialty->relSpecialty->relSubject2->name_ru }}</p>
                        @else
                            <h3>Сфера направления</h3>
                            <p>{{ (!is_null($specialty->relSpecialty->relSphere)) ? $specialty->relSpecialty->relSphere->name_ru : '' }}</p>
                        @endif
                    </div>
                    <div id="grant" class="tab-pane fade" role="tabpanel" tabindex="-1" aria-hidden="true" aria-labelledby="ui-tab-2">
                        @if(!empty($specialty->passing_score_kz) && !empty($specialty->number_grants_kz))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Казахское отделение</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">{{ $specialty->year }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Количество грантов</th>
                                        <th class="text-center">Проходной балл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $specialty->number_grants_kz }}</td>
                                        <td class="text-center">{{ $specialty->passing_score_kz }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        @if(!empty($specialty->passing_score_ru) && !empty($specialty->number_grants_ru))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Русское отделение</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">{{ $specialty->year }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Количество грантов</th>
                                        <th class="text-center">Проходной балл</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $specialty->number_grants_ru }}</td>
                                        <td class="text-center">{{ $specialty->passing_score_ru }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        @if(!empty($specialty->passing_score))
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Проходной балл на платное обучение</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">{{ $specialty->passing_score }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div id="rating" class="tab-pane fade" role="tabpanel" tabindex="-1" aria-hidden="true" aria-labelledby="ui-tab-3">
                        @if(count($rating) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th class="tl">Наименование ВУЗа</th>
                                        <th class="text-left">Город</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rating as $k => $v)
                                        <tr>
                                            <td><!--{{ $k+1 }}--> {{ $v->total }}</td>
                                            <td>{{ $v->relUniversity->name_ru }}</td>
                                            <td style="white-space: nowrap;">{{ $v->relUniversity->relCity->name_ru }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if(!empty($specialty->source))
                                    <tfoot>
                                        <tr>
                                            <td colspan='3'><b>Источник:</b> {{ $specialty->source }}</td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        @endif
                    </div>
                    <div id="doc" class="tab-pane fade" role="tabpanel" tabindex="-1" aria-hidden="true" aria-labelledby="ui-tab-4">
                        @if(is_object($requirement)) {!! $requirement->content_ru !!} @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="sgs-adress">
                    <h3>Контакты</h3>
                    <p><b>{{ $specialty->relUniversity->name_ru }}</b></p>
                    <p>{!! $specialty->relUniversity->subdivision !!}</p>
                    <p>{{ $specialty->relUniversity->address_ru }}</p>
                    <p>{{ $specialty->relUniversity->postcode }} {{ $specialty->relUniversity->relCity->name_ru }}</p>
                    <p>Тел.: {{ $specialty->relUniversity->phone }}</p>
                    <p>{{ $specialty->relUniversity->email }}</p>
                    <p>{{ $specialty->relUniversity->web_site }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
