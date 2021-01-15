@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="w-75 cabinet-mob cabinet ch-pwd">
                <div>
                    <h3 class="text-center">
                        <strong>Сменить пароль</strong>
                    </h3>
                </div>
                <form action="{{action('UserController@resetPassword')}}" method="post" class="">
                    @csrf
                    <div class="d-flex justify-content-center pl-md-0 ml-md-auto ml-1 pl-1 ">
                        <div class="m-change-passwd m-md-2 m-0 w-50">
                            <div class="bold-label-div mb-md-2 mb-0">
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Текущий пароль</label>
                                    </div>
                                    <input required name="passwd" class="login-form-input p-1 w-90" type="password">
                                </div>
                                @if(isset($e))
                                    <span class="text-danger m-2"><small>{{$e}}</small></span>
                                @endif
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Новый пароль</label>
                                    </div>
                                    <input required name="newPassword" class="login-form-input p-1 w-90" type="password">
                                </div>
                                @if($errors->first('newPassword'))
                                    <span class="text-danger m-2"><small>{{$errors->first('newPassword')}}</small></span>
                                @endif
                                <div class="w-100 cabinet-label-input m-2">
                                    <div>
                                        <label class="mb-1">Повторите пароль</label>
                                    </div>
                                    <input required name="newPassword_confirmation" class="login-form-input p-1 w-90" type="password">
                                </div>
                                @if($errors->first('newPassword_confirmation'))
                                    <span class="text-danger m-2"><small>{{$errors->first('newPassword_confirmation')}}</small></span>
                                @endif
                                <div class="w-100 cabinet-label-input m-md-2 ml-2 mt-4 mt-md-5">
                                    <button type="submit" class="btn text-capitalize w-90 btn-primary-custom">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
