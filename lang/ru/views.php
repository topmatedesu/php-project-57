<?php

return [
    'auth' => [
        'register' => [
            'register' => 'Зарегистрировать'
        ]
    ],
    'task' => [
        'name_required' => 'Это обязательное поле',
        'name_max' => 'Имя задачи не должно превышать 255 символов.',
        'description_max' => 'Описание не должно превышать 1000 символов.',
        'status_required' => 'Это обязательное поле',

        'created' => 'Задача успешно создана',
        'updated' => 'Задача успешно изменена',
        'deleted' => 'Задача успешно удалена',
        'cannot_delete' => 'Только создатель задачи может удалить ее',

        'create' => 'Создать задачу',
        'edit' => 'Изменение задачи',
        'show' => 'Просмотр задачи',
    ],
    'task-status' => [
        'name_required' => 'Это обязательное поле',
        'name_min' => 'Имя статуса должно содержать хотя бы один символ.',
        'name_max' => 'Имя статуса не должно превышать 255 символов.',
        'name_unique' => 'Статус с таким именем уже существует.',

        'created' => 'Статус успешно создан',
        'updated' => 'Статус успешно изменён',
        'deleted' => 'Статус успешно удалён',
        'cannot_delete' => 'Не удалось удалить статус',
        'unable_to_delete' => 'Невозможно удалить статус, связанный с задачей',

        'create' => 'Создать статус',
        'edit' => 'Изменение статуса',
        'show' => 'Просмотр статуса',
    ],
    'label' => [
        'name_required' => 'Это обязательное поле',
        'name_min' => 'Имя метки должно содержать хотя бы один символ.',
        'name_max' => 'Имя метки не должно превышать 255 символов.',
        'name_unique' => 'Метка с таким именем уже существует.',
        'description_max' => 'Описание не должно превышать 1000 символов.',

        'created' => 'Метка успешно создана',
        'updated' => 'Метка успешно изменена',
        'deleted' => 'Метка успешно удалена',
        'cannot_delete' => 'Не удалось удалить метку',

        'create' => 'Создать метку',
        'edit' => 'Изменение метки',
        'show' => 'Просмотр метки',
    ]
];
