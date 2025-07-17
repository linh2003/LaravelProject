<?php
return [
    'view' => [
        'title' => 'Quản lý phân quyền',
        'tableheading' => '',
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
            'phân quyền' => [],
            'Số lượng' => ['class' => 'text-center'],
            'Thao tác' => ['class' => 'text-center'],
        ]
    ],
    'create' => [
        'title' => 'Thêm mới quyền',
        'description' => '- Nhập mô tả về quyền người sử dụng',
        'note'   => '- <b class="text-danger">Lưu ý</b>: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
        'field' => [
            'name' => 'Tên quyền',
            'canonical' => 'Mã',
            'description' => 'Mô tả quyền',
        ],
    ],
    'update' => [
        'title'         => 'Chỉnh sửa quyền',
        'description'   => 'Chỉnh sửa mô tả về quyền người sử dụng',
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề quyền không được để trống.',
            'canonical' => [
                'required' => 'Mã không được trống.',
                'unique' => 'Mã đã tồn tại. Vui lòng nhập giá trị khác!'
            ]
        ],
    ]
];