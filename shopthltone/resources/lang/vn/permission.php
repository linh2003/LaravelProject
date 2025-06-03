<?php
return [
    'index' => [
        'title' => 'Phân quyền',
        'tableHeading' => 'Phân quyền',
        'columnHeading' => [
            'Phân quyền' => []
        ],
        'button' => [
            'create' => 'Thêm mới',
            'save' => 'Lưu thay đổi'
        ]
    ],
    'create' => [
        'title'         => 'Thêm mới quyền hạn',
        'description'   => 'Nhập mô tả về quyền hạn của người sử dụng',
        'note'   => '- Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
        'field' => [
            'name' => 'Phân quyền',
            'canonical' => 'Mã phân quyền',
            'description' => 'Mô tả quyền hạn',
        ],
        'button' => [
            'save' => 'Lưu',
            'cancel' => 'Hủy bỏ'
        ]
    ],
    'update' => [
        'title'         => 'Chỉnh sửa quyền hạn',
        'description'   => 'Chỉnh sửa mô tả về quyền hạn người sử dụng',
    ],
    'delete' => [
        'title' => 'Xóa quyền hạn'
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Quyền hạn không được để trống.',
            'canonical' => [
                'required' => 'Mã quyền hạn không được trống.',
                'unique' => 'Mã quyền hạn đã tồn tại. Vui lòng nhập giá trị khác'
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
        'rolepermission' => [
            'success' => 'Thay đổi vai trò phân quyền thành công',
            'error' => 'Thay đổi vai trò phân quyền thất bại!. Hãy thử lại!',
        ]
    ]
];