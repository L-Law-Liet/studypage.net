<?php
return [
    'driver' => env('MAIL_MAILER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.googlemail.com'),
    'port' => env('MAIL_PORT', 465),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS','auth.studypage.kz@gmail.com'),
        'name' => env('MAIL_NAME','StudyPage'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
    'username' => env('MAIL_USERNAME','auth.studypage.kz@gmail.com'),
    'password' => env('MAIL_PASSWORD','Test-123'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];
