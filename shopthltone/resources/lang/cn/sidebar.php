<?php
return [
    'module' => [
        [
            'title' => '仪表板',
            'icon'  => 'th-large',
            'route' => 'admin.dashboard',
            'name'  => 'dashboard',
        ],
        [
            'title' => '帖子',
            'icon'  => 'thumb-tack',
            'route' => 'admin.post',
            'name'  => 'post',
            'submodule' => [
                [
                    'title'     => '所有帖子',
                    'route'     => 'admin.post',
                    'name'      => 'post',
                ],
                [
                    'title'     => '目录帖',
                    'route'     => 'admin.post.cat',
                    'name'      => 'post.cat',
                ],
            ],
        ],
        [
            'title' => '用户',
            'icon'  => 'user',
            'route' => 'admin.user',
            'name'  => 'user',
            'submodule' => [
                [
                    'title'     => '所有用户',
                    'route'     => 'admin.user',
                    'name'      => 'user',
                ],
                [
                    'title'     => '用户组',
                    'route'     => 'user.roles',
                    'name'      => 'user.role',
                ],
            ],
        ],
        [
            'title' => '配置',
            'icon'  => 'cog',
            'route' => 'admin.language',
            'name'  => 'config',
            'submodule' => [
                [
                    'title'     => '语言',
                    'route'     => 'admin.language',
                    'name'      => 'config',
                ]
            ],
        ]
    ],
];