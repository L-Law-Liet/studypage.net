<p>
    Здравствуйте!
</p>
<p>Вы запросили восстановление учетных записей на сайте <a href="www.studypage.net">Studypage.net</a></p>
<div>
    Ваши учетные записи:
    @if(!empty($email))
        <p>Логин: {{$email}}</p>
        <p>Пароль: {{$password}}</p>
    @endif
</div>
<p>
    Рекомендуем Вам сохранить это письмо.
</p>
<p>
    Желаем Вам успешных поисков!
</p>
<p>С уважением, <br>
    Команда Studypage.net
</p>
<p>
    Это автоматически созданное сообщение. <br>
    Если у Вас возникли какие-либо вопросы, <br>
    можете задать вопрос через <a href="{{url('callback')}}">обратную связь</a>
</p>
