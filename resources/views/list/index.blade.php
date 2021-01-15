@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th class="tl">Наименование ВУЗа</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1 @endphp
                    @foreach($rating as $r)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$r->relUniversity->name_ru}}</td>
                            <td style="">{{$r->relCity->name_ru}}</td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                    <tr>
                        <td colspan="3"><b>Источник:</b> Независимое агентство аккредитации и рейтинга (НААР-2019)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
