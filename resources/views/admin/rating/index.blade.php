@extends('adminlte::page')

@section('title', 'Рейтинг '.($t == 1)?'ВУЗов':'колледжей')

@section('content_header')
    <h1>Рейтинг {{($t == 1)?'ВУЗов':'колледжей'}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{url('admin/rating/'.$t.'/add')}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="4%">№</th>
                                <th width="32%">Названия {{($t == 1)?'ВУЗов':'колледжей'}}</th>
                                {{--<th>Направление</th>--}}
                                <th width="24%">Направления</th>
                                <th width="16%">Итого</th>
                                 <th width="16%">Годы</th>
                                <th width="8%" colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($rating as $k => $v)
                            <tr>
                                <td>{{ $rating->firstItem()+$k }}</td>
                                <td><? if (!empty($v->relUniversity->name_ru)) { ?>{{ $v->relUniversity->name_ru }}<? } ?></td>
                                <td>@if(is_object($v->relProfile)){{ $v->relProfile->name }}@endif</td>
                                <td>{{ $v->rating??'0' }}</td>
                                <td>{{ \App\Models\Social::find(11-$t)->link }}</td>
                                <td>
                                    <a href="{{url('admin/rating/'.$t.'/view/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{url('admin/rating/'.$t.'/add/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{url('admin/rating/'.$t.'/delete/'.$v->id)}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Количество {{ $count }}</td>
                                <td colspan="6" class='text-center'>{{ $rating->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
