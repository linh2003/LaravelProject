<?php
return [
    'index' => [
        'title' => 'Quản lý người dùng',
        'tableHeading' => 'Danh sách người dùng',
        'counter' => 'Hiển thị',
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
            'TT' => ['class' => 'text-center'],
            'Người dùng' => [],
            'Thông tin chung' => [],
            'Vai trò' => ['class' => 'text-center', 'width' => '150px'],
            'Tình trạng' => ['class' => 'text-center'],
            'Đăng nhập lần cuối' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center'],
        ],
        'button' => [
            'publish' => 'Mở khóa người dùng',
            'unpublish' => 'Khóa người dùng',
            'changerole' => 'Thay đổi vai trò',
        ],
        'changerole' => 'Vai trò'
    ],
    'create' => [
        'title'         => 'Thêm mới vai trò',
        'description'   => 'Nhập mô tả về vai trò người sử dụng',
        'note'   => '- Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
        'field' => [
            'name' => 'Tên vai trò',
            'slug' => 'Mã vai trò',
            'description' => 'Mô tả vai trò',
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
        'option' => [
            'publish' => [
                'value' => 1,
                'text' => 'Đang hoạt động',
            ],
            'unpublish' => [
                'value' => 2,
                'text' => 'Đã khóa tài khoản',
            ]
        ],
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
        ],
        'changerole' => [
            'success' => 'Cập nhật vai trò thành công',
            'error' => 'Bạn chưa lựa chọn vai trò hoặc người dùng. Vui lòng kiểm lại!',
        ]
    ]
];