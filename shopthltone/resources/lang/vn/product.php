<?php
return [
    'index' => [
        'title' => 'Sản phẩm',
        'tableHeading' => 'Danh sách sản phẩm',
    ],
    'create' => [
        'title'         => 'Thêm mới sản phẩm',
        'description'   => 'Nhập mô tả về sản phẩm',
    ],
    'update' => [
        'title'         => 'Chỉnh sửa sản phẩm',
        'description'   => 'Chỉnh sửa sản phẩm',
    ],
    'delete' => [
        'title' => 'Xóa Sản phẩm'
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề sản phẩm không được để trống.',
            'canonical' => [
                'required' => 'Đường dẫn SEO không được trống.',
                'unique' => 'Đường dẫn SEO đã tồn tại. Vui lòng nhập giá trị khác'
            ],
            'catalogue' => 'Danh mục chưa được chọn'
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