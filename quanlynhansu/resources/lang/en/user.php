<?php
return [
    'index' => [
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
        'changerole' => [
            'title' => 'User role',
            'message' => [
                'success' => 'Change role for user success',
                'error' => 'Change role for user fail. Please try again!'
            ]
        ],
        'button' => [
            'publish' => 'Publish',
            'unpublish' => 'Unpublish',
            'changerole' => 'Change Role',
        ],
    ]
];