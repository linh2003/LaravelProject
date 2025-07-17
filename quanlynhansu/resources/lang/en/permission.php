<?php
return [
    'index' => [
        'title' => 'Manage Permission',
        'tableHeading' => 'Permission list',
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
            'Permission' => [],
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
        'title' => 'Create new Permission',
        'description' => 'Description of Permission',
        'note'   => '- <b class="text-danger">Note</b>: The marked fields <span class="text-danger">(*)</span> are required information!',
        'field' => [
            'name' => 'Permission name',
            'code' => 'Machine name',
            'description' => 'Description',
        ],
    ],
    'update' => [
        'title'         => 'Edit to Permission',
        'description'   => 'Edit description to Permission',
    ],
    'message' => [
        'request' => [
            'name' => 'Permission name is required.',
            'slug' => [
                'required' => 'Machine name of Permission is required.',
                'unique' => 'Machine name of Permission already exists. Please use a value different!'
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