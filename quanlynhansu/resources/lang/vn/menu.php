<?php
return [
    'modal' => [
        'left' => [
            'title' => 'Chọn liên kết hiển thị',
            'btnAddNewPosition' => 'Thêm mới vị trí hiển thị',
            'popup' => [
                'title' => 'Thêm mới vị trí hiển thị liên kết',
                'name' => 'Nhập tên vị trí hiển thị',
                'keyword' => 'Nhập từ khóa',
            ],
            'optionDefault' => 'Chọn liên kết hiển thị'
        ],
        'right' => [
            'title' => 'Chọn loại liên kết',
            'option' => [
                'dropdown' => 'Dropdown'
            ]
        ]
    ],
    'catalogue' => [
        'available' => [
            'title' => 'Liên kết có sẵn',
        ],
        'manual' => [
            'title' => 'Liên kết tự tạo',
            'content' => [
                'Cài đặt liên kết cần hiển thị',
                'Khi khởi tạo liên kết bạn phải chắc chắn đường dẫn đó có hoạt động',
                'Tiêu đề và đường dẫn của liên kết không được bỏ trống',
            ],
            'button' => 'Thêm đường dẫn'
        ],
    ],
    'list' => [
        'name' => 'Tên liên kết',
        'url' => 'Đường dẫn',
        'position' => 'Vị trí',
        'remove' => 'Xóa',
        'notification' => '<h4>Danh sách liên kết này chưa có bất kì đường dẫn nào.</h4><p>Hãy nhấn vào <span style="color:#17a2b8;">"Thêm đường dẫn" trong tab Liên kết tự tạo</span> để bắt đầu thêm.</p>'
    ],
    'message' => [
        'request' => [
            'menu_catalogue_id' => 'Loại menu không được trống'
        ],
        'create' => [
            'success' => 'Thêm mới bản ghi thành công',
            'error' => 'Thêm mới bản ghi thất bại. Hãy thử lại!',
        ],
    ]
];