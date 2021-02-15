@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-5 col-md-4 col-6">
                <p class="pull-left float-right">Результат: найдено <span class="count">{{number_format(count($universities), 0, "", " ")}}</span></p>
            </div>
            <div class="col-md-3 col-6 mt--3 m-md-auto mb-3">
                <div class="form-group pl-md-4 m-b-0">
                    <div class="where-select-sort">
                        <form id="regionForm" action="{{route(($universities[0]->hasCollege)?'list.college':'list.vuz')}}" method="get">
                            <select onchange="this.form.submit()" class="chsn form-control " id="sortReg" name="region">
                                <option hidden="hidden" value="">Регион</option>
                                @foreach($regions as $region)
                                    <option {{($region->id == $r)?'selected':''}} value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="tl">Наименования {{($universities[0]->hasCollege)?'колледжей':'ВУЗов'}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($universities??[] as $university)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if($university->description)
                                    <a class="college-list-a" href="{{route('college.view', ['name' => ($university->hasCollege)?'colleges':'universities', 'id' => $university->id])}}">{{$university->name_ru}}</a>
                                    @else
                                    <a class="college-list-a passive-list-a" style="cursor: default">{{$university->name_ru}}</a>
                                @endif
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
