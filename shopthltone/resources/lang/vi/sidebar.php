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
            'title' => 'Quản lý bài viết',
            'icon'  => 'thumb-tack',
            'route' => 'admin.post',
            'name'  => 'post',
            'submodule' => [
                [
                    'title'     => 'Quản lý bài viết',
                    'route'     => 'admin.post',
                    'name'      => 'post',
                ],
                [
                    'title'     => 'Quản lý nhóm bài viết',
                    'route'     => 'admin.post.cat',
                    'name'      => 'post.cat',
                ],
            ],
        ],
        [
            'title' => 'Quản lý người dùng',
            'icon'  => 'user',
            'route' => 'admin.user',
            'name'  => 'user',
            'submodule' => [
                [
                    'title'     => 'Quản lý thành viên',
                    'route'     => 'admin.user',
                    'name'      => 'user',
                ],
                [
                    'title'     => 'Quản lý nhóm thành viên',
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