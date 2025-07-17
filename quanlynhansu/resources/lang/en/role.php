<?php
return [
    'index' => [
        'title' => 'Manage Role',
        'tableHeading' => 'Role list',
        'counter' => 'Showing',
        'columnHeading' => [
            'checkbox' => [
                'width' => '15px',
                'input' => [
                    'type' => 'checkbox',
                    'class' => 'input-checkbox',
                    'name' => 'checkAll',
                    'id' => 'checkAll',
                    'value' => '',
                ]
            ],
            'No.' => ['class' => 'text-center'],
            'Role' => [],
            'Sum User' => ['class' => 'text-center'],
            'Action' => ['class' => 'text-center'],
        ],
        'button' => [
            'create' => 'Add new',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ]
    ],
    'create' => [
        'title' => 'Create new role',
        'description' => 'Description of role',
        'note'   => '- <b class="text-danger">Note</b>: The marked fields <span class="text-danger">(*)</span> are required information!',
        'field' => [
            'name' => 'Role name',
            'code' => 'Machine name',
            'description' => 'Description',
        ],
    ],
    'update' => [
        'title'         => 'Edit to role',
        'description'   => 'Edit description to role',
    ],
    'message' => [
        'request' => [
            'name' => 'Role name is required.',
            'slug' => [
                'required' => 'Machine name of role is required.',
                'unique' => 'Machine name of role already exists. Please use a value different!'
            ]
        ],
        'create' => [
            'success' => 'Insert new record successfully!',
            'error' => 'Insert new recored failed!. Please try again!',
        ],
        'update' => [
            'success' => 'Update record successfully!',
            'error' => 'Update recored failed!. Please try again!',
        ],
        'delete' => [
            'success' => 'Delete record successfully!',
            'error' => 'Delete recored faild!. Please try again!',
        ]
    ]
];