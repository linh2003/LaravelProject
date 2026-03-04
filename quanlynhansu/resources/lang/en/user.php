<?php
return [
    'index' => [
        'title' => 'User manage',
        'tableHeading' => 'User list',
        'column' => [
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
    ],
    'create' => [
        'title' => 'Add new user',
        'tabs' => [
            'generalInfor' => [
                'icon' => 'icofont-users',
                'label' => 'General information'
            ], 
            'personalInfor' => [
                'icon' => 'icofont-ui-user',
                'label' => 'Personal information'
            ], 
            'salary'=> [
                'icon' => 'icofont-money',
                'label' => 'Salary and bonus'
            ]
        ],
        'field' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'department' => 'Department',
            'cccd' => 'CCCD',
            'gender' => [
                'label' => 'Gender',
                'female' => 'Female',
                'male' => 'Male',
            ],
            'birthday' => 'Birthday',
            'dayofjoin' => 'Day of join',
            'dayofleave' => 'Day of leave',
            'dayoffnumber' => 'Day off number',
            'address' => 'Address',
            'salary' => 'Salary',
            'bonus' => 'Bonus',
            'bhxh' => 'BHXH number',
            'province' => 'Province',
            'district' => 'District',
            'ward' => 'Ward',
            'social' => [
                'label' => 'Social',
                'option' => [
                    [
                        'icon' => 'icofont-social-facebook',
                        'title' => 'Facebook'
                    ],
                    [
                        'icon' => 'icofont-social-twitter',
                        'title' => 'Twitter'
                    ],
                    [
                        'icon' => 'icofont-social-instagram',
                        'title' => 'Instagram'
                    ],
                    [
                        'icon' => 'icofont-brand-linkedin',
                        'title' => 'Linkedin'
                    ],
                ]
            ],
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'User name is required.',
            'email' => [
                'required' => 'Email is required.',
                'unique' => 'Email already exists. Please use a value different!'
            ],
            'password' => [
                'required' => 'Password is required.',
                'min' => 'Password must be at least 5 characters.',
            ],
            'phone' => [
                'required' => 'Phone is required.',
                'unique' => 'Phone already exists. Please use a value different!'
            ]
        ],
    ]
];