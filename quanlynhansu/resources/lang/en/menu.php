<?php
return [
    'modal' => [
        'left' => [
            'title' => 'Select link display',
            'btnAddNewPosition' => 'Add new display position',
            'popup' => [
                'title' => 'Add new display position of link',
                'name' => 'Enter display position name',
                'keyword' => 'Enter keyword',
            ],
            'optionDefault' => 'Select link display'
        ],
        'right' => [
            'title' => 'Select type',
            'option' => [
                'dropdown' => 'Dropdown'
            ]
        ]
    ],
    'catalogue' => [
        'task' => [
            'title' => 'Task',
            'sub' => [
                'view' => [
                    'label' => 'Task list',
                    'canonical' => 'task',
                    'route' => 'task',
                ],
            ]
        ],
        'user' => [
            'title' => 'Staff',
            'sub' => [
                'view' => [
                    'label' => 'Staff list',
                    'canonical' => 'user',
                    'route' => 'user'
                ],
                'role' => [
                    'label' => 'Role',
                    'canonical' => 'role',
                    'route' => 'role'
                ],
                'permission' => [
                    'label' => 'Permission',
                    'canonical' => 'permission',
                    'route' => 'permission'
                ]
            ]
        ],
        'manual' => [
            'title' => 'Link manual',
            'content' => [
                'Set the link to display',
                'When creating a link you must make sure the link is active.',
                'The title and path of the link cannot be empty.',
            ],
            'button' => 'Add new path'
        ]
    ],
    'list' => [
        'name' => 'Name',
        'url' => 'URL',
        'position' => 'Position',
        'remove' => 'Remove',
        'notification' => '<h4>This link list does not contain any links yet..</h4><p>Please click <span style="color:#17a2b8;">"Add new path" in Link manual tab</span> to start add new.</p>'
    ],
    'message' => [
        'request' => [
            'menu_catalogue_id' => 'Menu type is required.'
        ]
    ]
];