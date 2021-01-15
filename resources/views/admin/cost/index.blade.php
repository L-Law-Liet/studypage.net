@extends('adminlte::page')

@section('title', 'Специальность в ВУЗе')

@section('content_header')
    <h1>Специальность в ВУЗе</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <form action="/admin/cost/" method="GET">
                        <div class="form-group row">
                            <label class="col-md-2">Университет</label>
                            <div class="col-md-2">
                                <select name="university_id" class="form-control">
                                    <option></option>
                                    @if(isset($_GET['university_id']))
                                        @foreach($university as $k => $v)
                                            <option @if($k == $_GET['university_id']) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    @endif
                                    @if(!isset($_GET['university_id']))
                                        @foreach($university as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <label class="col-md-2">Степень</label>
                            <div class="col-md-2">
                                <select name="degree_id" class="form-control">
                                    <option></option>
                                    @foreach($degrees as $k => $v)
                                        @if(isset($_GET['degree_id']))
                                            <option @if($k == $_GET['degree_id']) selected @endif value="{{ $k }}">{{ $v }}</option>
                                        @endif
                                        @if(!isset($_GET['degree_id']))
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="cipher" class="form-control" placeholder="Шифр">
                            </div>
                            <div class="col-md-2">
                                <a href="/admin/cost/" class="btn btn-warning pull-right">Сбросить</a>
                                <button type="submit" class="btn btn-primary pull-right mr-15">Фильтр</button>
                            </div>
                        </div>
                    </form>
                    <a href="/admin/cost/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Университет</th>
                                <th>Специальность</th>
                                <th>Цена</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($cost as $k => $v)
                            <tr>
                                <td>{{ $cost->firstItem()+$k }}</td>
                                <td><a href="/admin/cost/view/{{ $v->id }}"><? if (!empty($v->relUniversity->name_ru)) { echo $v->relUniversity->name_ru; } ?></a></td>
                                <td><a href="/admin/cost/view/{{ $v->id }}"><? if (!empty($v->relSpecialty->cipher) AND $v->relSpecialty->cipher != null AND $v->relSpecialty->cipher != 'none') { echo $v->relSpecialty->cipher; } ?> - <? if (!empty($v->relSpecialty->name_ru) AND $v->relSpecialty->name_ru != null) { echo $v->relSpecialty->name_ru; } ?> </a></td>
                                <td><a href="/admin/cost/view/{{ $v->id }}">{{ number_format($v->price, 0, '', ' ') }}</a></td>
                                <td>
                                    <a href="/admin/cost/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/cost/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/cost/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '3'>Количество {{ $count }}</td>
                                <td colspan = '4' class='text-center'>{{ $cost->links() }}</td>
                            </tr>
                        </tfoot>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                        <script>
                                var l = getAllUrlParams($(this).attr('href'));
                                $('.pagination .page-link').each(function () {
                            	var nl = '/admin/cost?page=' + getAllUrlParams($(this).attr('href')).page;
                            	if (l.degree_id !== undefined) {
                                    nl = nl + '&degree_id=' + l.degree_id;
                                }
                                if (l.university_id !== undefined) {
                                    nl = nl + '&university_id=' + l.university_id;
                                }
                                $(this).attr('href', nl);
                            });
														function getAllUrlParams(url) {

															var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

															var obj = {};

															if (queryString) {

																queryString = queryString.split('#')[0];

																var arr = queryString.split('&');

																for (var i = 0; i < arr.length; i++) {
																	var a = arr[i].split('=');

																	var paramName = a[0];
																	var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

																	paramName = paramName.toLowerCase();
																	if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

																	// if the paramName ends with square brackets, e.g. colors[] or colors[2]
																	if (paramName.match(/\[(\d+)?\]$/)) {

																		// create key if it doesn't exist
																		var key = paramName.replace(/\[(\d+)?\]/, '');
																		if (!obj[key]) obj[key] = [];

																		// if it's an indexed array e.g. colors[2]
																		if (paramName.match(/\[\d+\]$/)) {
																			// get the index value and add the entry at the appropriate position
																			var index = /\[(\d+)\]/.exec(paramName)[1];
																			obj[key][index] = paramValue;
																		} else {
																			// otherwise add the value to the end of the array
																			obj[key].push(paramValue);
																		}
																	} else {
																		// we're dealing with a string
																		if (!obj[paramName]) {
																			// if it doesn't exist, create property
																			obj[paramName] = paramValue;
																		} else if (obj[paramName] && typeof obj[paramName] === 'string'){
																			// if property does exist and it's a string, convert it to an array
																			obj[paramName] = [obj[paramName]];
																			obj[paramName].push(paramValue);
																		} else {
																			// otherwise add the property
																			obj[paramName].push(paramValue);
																		}
																	}
																}
															}

															return obj;
														}
                        </script>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection