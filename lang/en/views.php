<?php

return [
    'auth' => [
        'register' => [
            'register' => 'Register'
        ]
    ],
    'task' => [
        'name_required' => 'This is a required field',
        'name_max' => 'The task name must not exceed 255 characters.',
        'description_max' => 'The description must not exceed 1000 characters.',
        'status_required' => 'This is a required field',

        'created' => 'Task created successfully',
        'updated' => 'Task updated successfully',
        'deleted' => 'Task removed successfully',
        'cannot_delete' => 'Only the creator of the task can delete it',

        'create' => 'Create Task',
        'edit' => 'Edit Task',
        'show' => 'View Task',
    ],
    'task-status' => [
        'name_required' => 'This is a required field',
        'name_min' => 'The status name must contain at least one character.',
        'name_max' => 'The status name must not exceed 255 characters.',
        'name_unique' => 'A status with this name already exists.',

        'created' => 'Status created successfully',
        'updated' => 'Status updated successfully',
        'deleted' => 'Status removed successfully',
        'cannot_delete' => 'Cannot delete Status',

        'create' => 'Create Status',
        'edit' => 'Edit Status',
        'show' => 'View Status',
    ],
    'label' => [
        'name_required' => 'This is a required field',
        'name_min' => 'The label name must contain at least one character.',
        'name_max' => 'The label name must not exceed 255 characters.',
        'name_unique' => 'A label with this name already exists.',
        'description_max' => 'The description must not exceed 1000 characters.',

        'created' => 'Label created successfully',
        'updated' => 'Label updated successfully',
        'deleted' => 'Label removed successfully',
        'cannot_delete' => 'Cannot delete Label',

        'create' => 'Create Label',
        'edit' => 'Edit Label',
        'show' => 'View Label',
    ]
];
