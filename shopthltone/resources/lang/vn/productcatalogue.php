<?php
return [
    'create' => [
        'title'         => 'Thêm mới danh mục sản phẩm',
        'description'   => 'Nhập mô tả về danh mục sản phẩm',
        'tab'   => [
            'Thông tin chung',
            'Cấu hình SEO',
            'Bộ sưu tập ảnh',
        ],
        'field' => [
            'name' => 'Tên danh mục sản phẩm',
            'parent' => [
                'label' => 'Danh mục cha',
                'optionDefault' => 'Danh mục cha',
            ],
            'description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'meta_title' => 'Tiêu đề SEO',
            'meta_keyword' => 'Từ khóa SEO',
            'meta_description' => 'Mô tả SEO',
            'canonical' => 'Đường dẫn',
            'publish' => 'Xuất bản',
            'follow' => 'Theo dõi',
        ],
        'modal' => [
            'title' => 'Nhập tiêu đề SEO',
            'description' => 'Nhập nội dung mô tả',
            'nestable' => [
                'expand' => 'Mở rộng tất cả',
                'collapse' => 'Thu gọn tất cả'
            ]
        ]
    ],
    'update' => [
        'title'         => 'Chỉnh sửa danh mục sản phẩm',
        'description'   => 'Chỉnh sửa mô tả về danh mục sản phẩm người sử dụng',
    ],
    'delete' => [
        'title' => 'Bạn có chắc chắn muốn xóa danh mục sản phẩm',
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề danh mục sản phẩm không được để trống.',
            'canonical' => [
                'required' => 'Mã danh mục sản phẩm không được trống.',
                'unique' => 'Mã danh mục sản phẩm đã tồn tại. Vui lòng nhập giá trị khác!'
            ],
            'delChild' => 'Không thể xóa vì vẫn còn danh mục con'
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