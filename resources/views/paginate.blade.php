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
                        <option value="name" @if($sort == 'name') selected @endif>Наименование</option>
                        <option value="town" @if($sort == 'town') selected @endif>Город</option>
                        <option value="cost" @if($sort == 'cost') selected @endif>Стоимость</option>
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
                            <strong><? if ($v->relSpecialty->cipher != null AND $v->relSpecialty->cipher != 'none') { ?>{{ $v->relSpecialty->cipher }} •<? } ?> {{$v->relSpecialty->name_ru }}</strong>
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
                                <td>Стоимость обучение</td>
                                <td>{{ number_format($v->price, 0, '', ' ') }} тг. @if($v->price != 0)/ год @endif</td>
                            </tr>
                            @if($degree_id == 1 OR isset($v->relSpecialty->relSubject->name_ru)) {{--Бакалавр--}}
                            <tr>
                                <td>Профильный предмет</td>
                                <td>{{ $v->relSpecialty->relSubject->name_ru }}, {{ $v->relSpecialty->relSubject2->name_ru }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>Сфера направления</td>
                                <td>{{ $v->relSpecialty->relSphere->name_ru }}</td>
                            </tr>
                            @endif
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