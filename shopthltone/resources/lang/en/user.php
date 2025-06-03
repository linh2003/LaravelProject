<?php
return [
    'index' => [
        'title' => 'Manage User',
        'tableHeading' => 'User list',
        'counter' => 'Showing',
        'columnHeading' => [
            'checkbox' => [
                'input' => [
                    'type' => 'checkbox',
                    'class' => 'input-checkbox',
                    'name' => 'checkAll',
                    'id' => 'checkAll',
                    'value' => '',
                ]
            ],
            'No.' => ['class' => 'text-center'],
            'User' => [],
            'Description' => [],
            'Role' => ['class' => 'text-center', 'width' => '150px'],
            'Status' => ['class' => 'text-center'],
            'Last login' => ['class' => 'text-center', 'width' => '100px'],
            'Action' => ['class' => 'text-center'],
        ],
        'button' => [
            'publish' => 'Publish user',
            'unpublish' => 'Unpublish user',
            'changerole' => 'Change Role',
        ],
        'changerole' => 'Roles'
    ],
    'create' => [
        'title'         => 'Create User',
        'description'   => 'Description of User',
        'note'   => '- <b class="text-danger">Note</b>: The marked fields <span class="text-danger">(*)</span> are required information!',
        'field' => [
            'name' => 'User name',
            'slug' => 'Machine name',
            'description' => 'Description',
        ]
    ],
    'update' => [
        'title'         => 'Edit to User',
        'description'   => 'Edit description to User',
    ],
    'delete' => [
        'title' => 'Delete to User'
    ],
    'filter' => [
        'option' => [
            'publish' => [
                'value' => 1,
                'text' => 'Publish',
            ],
            'unpublish' => [
                'value' => 2,
                'text' => 'Unpublish',
            ]
        ],
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'User name is required.',
            'slug' => [
                'required' => 'Machine name of User is required.',
                'unique' => 'Machine name of User already exists. Please use a value different!'
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
        ],
        'changerole' => [
            'success' => 'Update role for user successfully!',
            'error' => 'You have not selected a role or user. Please check again!',
        ]
    ]
];