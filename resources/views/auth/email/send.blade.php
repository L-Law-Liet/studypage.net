<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body class="p-1">
<p>
    Здраствуйте!
</p>
<p>
    Вы зарегистрировались на сайте <a href="www.studypage.net">Studypage.net</a>
</p>
<p>Логин: {{$user['email']}}
</p>
<p>Для подтверждения регистрации аккаунта перейдите по ссылке:
</p>
<a href="{{url('user/verify', $user->verifyUser->token)}}" style="background: linear-gradient(to bottom, #4b8dc8 0, #2d7cc0 100%) !important;; padding: 0.5rem 1.2rem; text-decoration: none; color: white">ПОДТВЕРДИТЬ</a>
<p>Рекомендуем Вам сохранить это письмо.
</p>
<p>Желаем Вам успешных поисков!
</p>
<p>С уважением, <br>
    Команда Studypage.net
</p>
<p>
    Это автоматически созданное сообщение. <br>
    Если у Вас возникли какие-либо вопросы, <br>
    можете задать вопрос через <a href="{{url('callback')}}">обратную связь</a>
</p>
</body>

</html>
