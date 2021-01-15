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

    <div class="container pt-2">
        <div class="row">
            <div class="col-8">
                <div id="college-view-right">
                    <h4 class="text-center mb-4">ГРАНТЫ / СКИДКИ</h4>
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-view">
                                    <thead>
                                    <tr>
                                        <th>№</th>
                                        <th class="">Группа образовательных программ</th>
                                        <th width="35%;">Кол-во выделенных грантов</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($university->grantS as $grant)

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{$grant->name}}</td>
                                            <td class="tl">{{$grant->count_grants}}</td>
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
                </div>
            </div>
            @include('college/college-navbar')
        </div>
    </div>
@endsection
