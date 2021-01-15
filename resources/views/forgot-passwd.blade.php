@extends('layouts.app')
@section('content')
    <div class="min-heigh-310px">
        <div class="login-content">
            <div class="justify-content-center d-flex">
                <div id="form" class="forgot-passwd-form p-3">
                    <div class="m-3">
                        <div id="login-header">
                            Восстановление пароля
                        </div>
                        <div class="forgot-passwd-subtitle pr-5">
                            Введите электронную почту или телефон, указанный при регистрации. На указанную Вами
                            электронную почту или телефон придет письмо со ссылкой для восстановления пароля.
                        </div>
                    </div>
                    <form id="login-form" action="" class="p-2 m-1">
                        <div class="login-form-div">
                            <label>Электронная почта или телефон*</label>
                            <input class="login-form-input p-1" type="text">
                        </div>
                        <div class="clearfix">
                            <div class="form-group text-center p-2 m-1">
                                <button type="submit" class="btn w-50 text-capitalize btn-primary-custom">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
