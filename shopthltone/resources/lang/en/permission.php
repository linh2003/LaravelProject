<?php
return [
    'index' => [
        'title' => 'Manage Permission',
        'tableHeading' => 'Permission list',
        'columnHeading' => [
            'Permission' => []
        ],
        'button' => [
            'create' => 'Add new',
            'save' => 'Save change'
        ]
    ],
    'create' => [
        'title'         => 'Create Permission',
        'description'   => 'Description of Permission',
        'note'   => '- <b class="text-danger">Note</b>: The marked fields <span class="text-danger">(*)</span> are required information!',
        'field' => [
            'name' => 'Permission name',
            'canonical' => 'Machine name',
            'description' => 'Description',
        ],
        'button' => [
            'save' => 'Save',
            'cancel' => 'Cancel'
        ]
    ],
    'update' => [
        'title'         => 'Edit to Permission',
        'description'   => 'Edit description to Permission',
    ],
    'delete' => [
        'title' => 'Delete to Permission'
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
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
        ],
        'rolepermission' => [
            'success' => 'Change role permission successfully!',
            'error' => 'Change role permission faild!. Please try again!',
        ]
    ]
];