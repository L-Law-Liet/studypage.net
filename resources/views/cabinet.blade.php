@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet-mob cabinet">
                <div>
                    <h3 class="text-center">Личные данные</h3>
                </div>
                <form action="{{action('UserController@edit')}}" method="post" class="">
                    @csrf
                    <div class="d-flex justify-content-between flex-md-row flex-column bold-label-div">
                        <div class="m-2 w-100">
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Фамилия</label>
                                </div>
                                <input required name="surname" class="login-form-input p-1 w-90" type="text" value="{{Auth::user()->surname}}">
                            </div>
                            @if($errors->first('surname'))
                            <span class="text-danger m-2"><small>{{$errors->first('surname')}}</small></span>
                            @endif
                            <div class="mobile">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Имя</label>
                                    </div>
                                    <input id="name-mob" required name="name" class="login-form-input p-1 w-90" type="text" value="{{Auth::user()->name}}">
                                </div>
                                @if($errors->first('name'))
                                    <span class="text-danger m-2"><small>{{$errors->first('name')}}</small></span>
                                @endif
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Дата рождения</label>
                                </div>
                                <input required name="birthDate" class="login-form-input p-1 w-90" type="date" max="2020-01-01" min="1920-01-01" value="{{Auth::user()->birthDate}}">
                            </div>
                            @if($errors->first('birthDate'))
                                <span class="text-danger m-2"><small>{{$errors->first('birthDate')}}</small></span>
                            @endif
                            <div class="mobile">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Пол</label>
                                    </div>
                                    <select id="gender-mob" required class="login-form-input p-1 w-90" name="gender">
                                        <option @if(Auth::user()->gender == 'm') selected @endif value="m">Мужчина</option>
                                        <option @if(Auth::user()->gender == 'fm') selected @endif value="fm">Женщина</option>
                                    </select>
                                </div>
                                @if($errors->first('gender'))
                                    <span class="text-danger m-2"><small>{{$errors->first('gender')}}</small></span>
                                @endif
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Регион</label>
                                </div>
                                <select required class="login-form-input p-1 w-90" name="city">
                                    <option value=""></option>
                                    @foreach($cities as $city)
                                    <option @if(Auth::user()->region == $city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
{{--                               <input class="login-form-input" type="text" value="{{Auth::user()->region}}">--}}
                                </select>
                            </div>
                            @if($errors->first('city'))
                                <span class="text-danger m-2"><small>{{$errors->first('city')}}</small></span>
                            @endif
                            <div class="mobile">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Электронная почта</label>
                                    </div>
                                    <input id="email-mob" required name="email" class="login-form-input p-1 w-90" type="email" value="{{Auth::user()->email}}">
                                </div>
                                @if($errors->first('email'))
                                    <span class="text-danger m-2"><small>{{$errors->first('email')}}</small></span>
                                @endif
                            </div>
                            <div class="w-100 cabinet-label-input m-2">
                                <div>
                                    <label class="mb-1">Контактный телефон</label>
                                </div>
                                <input required name="phone" class="login-form-input p-1 w-90 phone_mask" type="tel" value="{{Auth::user()->phone}}">
                            </div>
                            @if($errors->first('phone'))
                                <span class="text-danger m-2"><small>{{$errors->first('phone')}}</small></span>
                            @endif
                        </div>
                        <div class="pc w-100">
                            <div class="m-2 w-100">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Имя</label>
                                    </div>
                                    <input id="name-pc" required name="name" class="login-form-input p-1 w-90" type="text" value="{{Auth::user()->name}}">
                                </div>
                                @if($errors->first('name'))
                                    <span class="text-danger m-2"><small>{{$errors->first('name')}}</small></span>
                                @endif
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Пол</label>
                                    </div>
                                    <select id="gender-pc" required class="login-form-input p-1 w-90" name="gender">
                                        <option @if(Auth::user()->gender == 'm') selected @endif value="m">Мужчина</option>
                                        <option @if(Auth::user()->gender == 'fm') selected @endif value="fm">Женщина</option>
                                    </select>
                                </div>
                                @if($errors->first('gender'))
                                    <span class="text-danger m-2"><small>{{$errors->first('gender')}}</small></span>
                                @endif
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Электронная почта</label>
                                    </div>
                                    <input id="email-pc" required name="email" class="login-form-input p-1 w-90" type="email" value="{{Auth::user()->email}}">
                                </div>
                                @if($errors->first('email'))
                                    <span class="text-danger m-2"><small>{{$errors->first('email')}}</small></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="text-center mt-0 mt-md-3 pt-2">
                            <button type="submit" class="btn col-md-5 w-90 text-capitalize btn-primary-custom">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".mobile").on('change', function () {
            $("#gender-pc").prop('value', $("#gender-mob").prop("value"));
        });
        $(".mobile").on('input', function () {
            $("#name-pc").prop('value', $("#name-mob").prop("value"));
            $("#email-pc").prop('value', $("#email-mob").prop("value"));
        });
        $(".pc").on('change', function () {
            $("#gender-mob").prop('value', $("#gender-pc").prop("value"));
        });
        $(".pc").on('input', function () {
            $("#name-mob").prop('value', $("#name-pc").prop("value"));
            $("#email-mob").prop('value', $("#email-pc").prop("value"));
        });
    </script>
    @endsection
