<?php
return [
    'index' => [
        'title' => 'Quản lý thuộc tính',
        'tableHeading' => 'Danh sách thuộc tính',
        'counter' => 'Hiển thị',
        'columnHeading' => [
            'checkbox' => [
                'width' => '15px',
                'input' => [
                    'type' => 'checkbox',
                    'class' => 'input-checkbox input-checkbox-all-list-data',
                    'name' => 'checkAll',
                    'id' => 'checkAll',
                ]
            ],
            'TT' => ['class' => 'text-center'],
            'Thuộc tính' => [],
            'Nhóm thuộc tính' => [],
            'Trạng thái' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'create' => 'Thêm mới',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'publish' => 'Mở thuộc tính',
            'unpublish' => 'Khóa thuộc tính',
        ]
    ],
    'create' => [
        'title'         => 'Thêm mới thuộc tính',
        'description'   => 'Nhập mô tả về thuộc tính',
        'tab'   => [
            'Thông tin chung',
            'Cấu hình SEO',
            'Bộ sưu tập ảnh',
        ],
        'field' => [
            'name' => 'Tên thuộc tính',
            'attribute_type' => 'Nhóm thuộc tính',
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
        ]
    ],
    'update' => [
        'title'         => 'Chỉnh sửa thuộc tính',
        'description'   => 'Chỉnh sửa mô tả về thuộc tính người sử dụng',
    ],
    'delete' => [
        'title' => 'Bạn có chắc chắn muốn xóa thuộc tính',
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề thuộc tính không được để trống.',
            'canonical' => [
                'required' => 'Mã thuộc tính không được trống.',
                'unique' => 'Mã thuộc tính đã tồn tại. Vui lòng nhập giá trị khác!'
            ],
            'delete' => 'Không thể xóa vì vẫn có module sử dụng thuộc tính này!'
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