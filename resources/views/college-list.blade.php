@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-view">
                    <thead>
                    <tr>
                        <th class="w-30px">№</th>
                        <th class="tl">Наименования {{($universities[0]->hasCollege)?'колледжей':'ВУЗов'}}</th>
                        <th width="20%;">Регион</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($universities as $university)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if($university->description)
                                    <a class="college-list-a" href="{{route('college.view', ['name' => ($university->hasCollege)?'college':'vuz', 'id' => $university->id])}}">{{$university->name_ru}}</a>
                                    @else
                                    <a class="college-list-a passive-list-a" style="cursor: default">{{$university->name_ru}}</a>
                                @endif
                            </td>
                            <td style="">{{$university->relRegion->name??''}}</td>
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
