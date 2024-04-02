<?php

use App\Events\RegistrationDataReceivedEvent;

$dialogConfig = [
    "intro" => "Для регистрации предоставьте данные о себе. Я попрошу вас сообщить мне => фамилию, имя, отчество, пол и дату рождения",
    "outro" => [
        "message" => <<<TEXT
Спасибо! 
На регистрацию переданы следующие данные:
* Фамилия: {last_name}
* Имя: {first_name}
* Отчество: {middle_name}
* Пол: {gender}
* Дата рождения: {birthday}
TEXT,
        "delegateResultTo" => RegistrationDataReceivedEvent::class
    ],
    "questions" => [
        [
            "last_name" => [
                "question" => "Напишите свою фамилию",
                "rules" => [
                    [
                        "rule" => "string =>max =>255",
                        "message" => "Извините, это не похоже на фамилию. Попробуйте ещё раз. Длина должна быть не больше 255 символов"
                    ]
                ]
            ],
            "first_name" => [
                "question" => "Напишите своё имя",
                "rules" => [
                    [
                        "rule" => "string =>max =>255",
                        "message" => "Извините, это не похоже на имя. Попробуйте ещё раз. Длина должна быть не больше 255 символов"
                    ]
                ]
            ],
            "middle_name" => [
                "question" => "Напишите своё отчество",
                "optional" => true,
                "rules" => [
                    [
                        "rule" => "string =>max =>255",
                        "message" => "Извините, это не похоже на имя. Попробуйте ещё раз. Длина должна быть не больше 255 символов"
                    ]
                ]
            ],
            "gender" => [
                "question" => "Какого вы пола?",
                "inlineAnswers" => [
                    "male" => "М",
                    "female" => "Ж"
                ]
            ],
            "birthday" => [
                "question" => "Напишите дату рождения. Формат => ГГГГ-ММ-ДД",
                "optional" => true
            ]
        ]
    ]
];