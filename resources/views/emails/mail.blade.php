<p>
    <? if (!empty($name)) { ?>
    Имя: <strong>{{ $name }}</strong><br>
    <? } ?>
    <? if (!empty($phone)) { ?>
    Контактный телефон: <strong>{{ $phone }}</strong><br>
    <? } ?>
    <? if (!empty($email)) { ?>
    Электронная почта: <strong>{{ $email }}</strong><br>
    <? } ?>
    <? if (!empty($question)) { ?>
    Сообщение: <strong>{{ $question }}</strong>
    <? } ?>
    <? if (!empty($contact_name)) { ?>
    Имя контактного лица: <strong>{{ $contact_name }}</strong><br>
    <? } ?>
    <? if (!empty($university_name)) { ?>
    Название учебного заведения: <strong>{{ $university_name }}</strong><br>
    <? } ?>
    <? if (!empty($contact_phone)) { ?>
    Контактный телефон: <strong>{{ $contact_phone }}</strong><br>
    <? } ?>
    <? if (!empty($email2)) { ?>
    Электронная почта: <strong>{{ $email2 }}</strong>
    <? } ?>
</p>