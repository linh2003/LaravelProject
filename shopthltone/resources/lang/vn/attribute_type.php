<?php
return [
    'index' => [
        'title' => 'Quản lý nhóm thuộc tính',
        'tableHeading' => 'Danh sách nhóm thuộc tính',
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
            'Loại thuộc tính' => [],
            'Trạng thái' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'create' => 'Thêm mới',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'publish' => 'Mở loại thuộc tính',
            'unpublish' => 'Khóa loại thuộc tính',
        ]
    ],
    'create' => [
        'title'         => 'Thêm mới nhóm thuộc tính',
        'description'   => 'Nhập mô tả về nhóm thuộc tính người sử dụng',
        'tab'   => [
            'Thông tin chung',
            'Cấu hình SEO',
            'Bộ sưu tập ảnh',
        ],
        'field' => [
            'name' => 'Tên nhóm thuộc tính',
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
        'title'         => 'Chỉnh sửa nhóm thuộc tính',
        'description'   => 'Chỉnh sửa mô tả về nhóm thuộc tính người sử dụng',
    ],
    'delete' => [
        'title' => 'Bạn có chắc chắn muốn xóa nhóm thuộc tính',
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề nhóm thuộc tính không được để trống.',
            'canonical' => [
                'required' => 'Mã nhóm thuộc tính không được trống.',
                'unique' => 'Mã nhóm thuộc tính đã tồn tại. Vui lòng nhập giá trị khác!'
            ],
            'delete' => 'Không thể xóa vì vẫn chứa các thuộc tính con'
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