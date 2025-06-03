<?php
return [
    'index' => [
        'title' => 'Quản lý vai trò',
        'tableHeading' => 'Danh sách vai trò',
        'counter' => 'Hiển thị',
        'columnHeading' => [
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
        'title'         => 'Thêm mới vai trò',
        'description'   => 'Nhập mô tả về vai trò người sử dụng',
        'note'   => '- Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
        'field' => [
            'name' => 'Tên vai trò',
            'slug' => 'Mã vai trò',
            'description' => 'Mô tả vai trò',
        ],
        'button' => [
            'save' => 'Lưu',
            'cancel' => 'Hủy bỏ'
        ]
    ],
    'update' => [
        'title'         => 'Chỉnh sửa vai trò',
        'description'   => 'Chỉnh sửa mô tả về vai trò người sử dụng',
    ],
    'delete' => [
        'title' => 'Xóa vai trò'
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề vai trò không được để trống.',
            'slug' => [
                'required' => 'Mã vai trò không được trống.',
                'unique' => 'Mã vai trò đã tồn tại. Vui lòng nhập giá trị khác'
            ]
        ],
        'create' => [
            'success' => 'Thêm mới bản ghi thành công',
            'error' => 'Thêm mới bản ghi thất bại. Hãy thử lại!',
        ],
        'update' => [
            'success' => 'Cập nhật bản ghi thành công',
            'error' => 'Cập nhật bản ghi thất bại. Hãy thử lại!',
        ],
        'delete' => [
            'success' => 'Xóa dữ liệu thành công',
            'error' => 'Xóa dữ liệu thất bại. Hãy thử lại!',
        ]
    ]
];