<?php
return [
    'index' => [
        'tableHeading' => 'Danh sách nhân sự',
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
            'TT' => ['class' => 'text-center'],
            'Nhân sự' => [],
            'Thông tin chung' => [],
            'Vai trò' => ['class' => 'text-center', 'width' => '150px'],
            'Tình trạng' => ['class' => 'text-center'],
            'Đăng nhập lần cuối' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center'],
        ],
        'changerole' => [
            'title' => 'Vai trò người dùng',
            'message' => [
                'success' => 'Thay đổi vai trò thành công',
                'error' => 'Thay đổi vai trò thất bại. Vui lòng thử lại!'
            ]
        ],
        'button' => [
            'publish' => 'Mở khóa người dùng',
            'unpublish' => 'Khóa người dùng',
            'changerole' => 'Thay đổi vai trò',
        ],
    ]
];