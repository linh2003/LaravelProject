<?php
return [
    'view' => [
        'title' => 'Quản lý vai trò',
        'tableheading' => 'Danh sách vai trò',
        'counter' => 'Hiển thị',
        'column' => [
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
            'TT' => ['class' => 'text-center'],
            'Vai trò' => [],
            'Số lượng' => ['class' => 'text-center'],
            'Thao tác' => ['class' => 'text-center'],
        ],
        'button' => [
            'create' => 'Thêm mới',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ]
    ],
    'create' => [
        'title' => 'Thêm mới vai trò',
        'description' => '- Nhập mô tả về vai trò người sử dụng',
        'note'   => '- <b class="text-danger">Lưu ý</b>: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
        'field' => [
            'name' => 'Tên vai trò',
            'code' => 'Mã vai trò',
            'description' => 'Mô tả vai trò',
        ],
    ],
    'update' => [
        'title'         => 'Chỉnh sửa vai trò',
        'description'   => 'Chỉnh sửa mô tả về vai trò người sử dụng',
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề vai trò không được để trống.',
            'code' => [
                'required' => 'Mã vai trò không được trống.',
                'unique' => 'Mã vai trò đã tồn tại. Vui lòng nhập giá trị khác!'
            ]
        ],
    ]
];