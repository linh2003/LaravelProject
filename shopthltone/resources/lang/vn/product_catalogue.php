<?php
return [
    'index' => [
        'title' => 'Danh mục sản phẩm',
        'tableHeading' => 'Danh mục sản phẩm',
    ],
    'create' => [
        'title'         => 'Thêm mới danh mục sản phẩm',
        'description'   => 'Nhập mô tả về danh mục sản phẩm',
    ],
    'update' => [
        'title'         => 'Chỉnh sửa danh mục sản phẩm',
        'description'   => 'Chỉnh sửa danh mục sản phẩm',
    ],
    'delete' => [
        'title' => 'Xóa danh mục Sản phẩm'
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề danh mục sản phẩm không được để trống.',
            'canonical' => [
                'required' => 'Đường dẫn SEO không được trống.',
                'unique' => 'Đường dẫn SEO đã tồn tại. Vui lòng nhập giá trị khác'
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