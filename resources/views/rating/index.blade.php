@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                        <tr>
                            <th class="w-30px">№</th>
                            <th class="tl">Наименование ВУЗа</th>
                            <th width="20%;">Город</th>
                            {{--<th class="text-center">Итого (Балл)</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                    @php $category_id = null; @endphp
                    @foreach($rating as $k => $v)
                        @php $category_id = $v->category_id; @endphp
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $v->relUniversity->name_ru }}</td>
                            <td style="white-space: nowrap;">{{ $v->relCity->name_ru }}</td>
                            {{--<td class="text-center">{{ $v->overall_rating }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                    @if(is_object($ranking) && !empty($ranking->source))
                        <tfoot>
                            <tr>
                                <td colspan = '3'><b>Источник:</b> {{ $ranking->source }}</td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            {{--<div class="col-md-3 right-block city-menu">
                <ul class="nav flex-column">
                    @foreach($categories as $k => $v)
                        <li class="nav-item">
                            <a class="nav-link @if($k == $category_id) active @endif" href="/rating/{{$k}}">
                                <span class="sprites @if($k == $category_id) down @else intern @endif"></span>{{$v}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>--}}
        </div>
    </div>
@endsection
