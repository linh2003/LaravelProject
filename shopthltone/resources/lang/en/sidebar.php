<?php
return [
    'module' => [
        [
            'title' => 'Dashboard',
            'icon'  => 'th-large',
            'route' => 'admin.dashboard',
            'name'  => 'dashboard',
        ],
        [
            'title' => 'Posts',
            'icon'  => 'thumb-tack',
            'route' => 'admin.post',
            'name'  => 'post',
            'submodule' => [
                [
                    'title'     => 'All Posts',
                    'route'     => 'admin.post',
                    'name'      => 'post',
                ],
                [
                    'title'     => 'Catalogue Post',
                    'route'     => 'admin.post.cat',
                    'name'      => 'post.cat',
                ],
            ],
        ],
        [
            'title' => 'Users',
            'icon'  => 'user',
            'route' => 'admin.user',
            'name'  => 'user',
            'submodule' => [
                [
                    'title'     => 'All Users',
                    'route'     => 'admin.user',
                    'name'      => 'user',
                ],
                [
                    'title'     => 'User group',
                    'route'     => 'user.roles',
                    'name'      => 'user.role',
                ],
            ],
        ],
        [
            'title' => 'Configuration',
            'icon'  => 'cog',
            'route' => 'admin.language',
            'name'  => 'config',
            'submodule' => [
                [
                    'title'     => 'Languages',
                    'route'     => 'admin.language',
                    'name'      => 'config',
                ]
            ],
        ]
    ],
];