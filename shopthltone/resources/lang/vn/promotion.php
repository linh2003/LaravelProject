<?php
return [
    'index' => [
        'title' => 'Quản lý khuyến mại',
        'tableHeading' => 'Danh sách chương trình khuyến mãi',
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
            'Chương trình khuyến mãi' => [],
            'Thời gian' => ['class' => 'text-center'],
            'Trạng thái' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'label' => [
            'code' => 'Mã khuyến mại',
            'start' => 'Từ',
            'end' => 'đến',
            'due' => 'Hết hạn',
        ],
        'button' => [
            'create' => 'Thêm mới',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'publish' => 'Mở chương trình',
            'unpublish' => 'Khóa chương trình',
        ]
    ],
    'create' => [
        'title' => 'Thêm mới khuyến mại',
        'titleBoxLeft' => 'Thông tin khuyến mại',
        'titleBoxRight' => 'Thời gian áp dụng',
        'titleBoxRightBottom' => 'Trạng thái',
        'field' => [
            'name' => 'Tên chương trình',
            'code' => 'Mã chương trình',
            'description' => 'Mô tả khuyến mại',
            'startDate' => 'Ngày bắt đầu',
            'endDate' => 'Ngày kết thúc',
            'type' => [
                'label' => 'Hình thức khuyến mại',
                'option' => [
                    'none' => 'Chọn hình thức',
                    'product' => 'Sản phẩm',
                    'value_product' => 'Giá trị sản phẩm',
                    // 'invoice' => 'Hóa đơn',
                ]
            ],
            'type_option' => [
                'value_product' => [
                    'begin' => 'Giá trị từ',
                    'end' => 'Giá trị đến',
                    'discountValue' => 'Chiết khấu',
                    'discount' => [
                        'cash' => 'VND',
                        'percent' => '%',
                    ],
                    'button' => 'Thêm điều kiện',
                    'error' => [
                        'required' => 'Trường điều kiện đang trống!',
                        'conflict' => 'Điều kiện bắt đầu phải nhỏ hơn điều kiện kết thúc!',
                        'invalid' => 'Khoảng điều kiện không hợp lệ. Vui lòng nhập lại!',
                    ]
                ],
                'product' => [
                    'radio' => ['Sản phẩm', 'Danh mục sản phẩm'],
                    'name' => [
                        'product' => 'Chọn Sản phẩm',
                        'productcatalogue' => 'Chọn Danh mục Sản phẩm',
                    ],
                    'search' => 'Tìm kiếm ...',
                    'modal' => [
                        'close' => 'Đóng',
                        'save' => 'Lưu',
                        'quantity' => 'Số lượng: ',
                        'price' => 'Giá: ',
                        'sku' => 'Mã sản phẩm: ',
                    ]
                ]
            ]
        ]
    ],
    'update' => [
        'title'         => 'Chỉnh sửa khuyến mại',
        'description'   => 'Chỉnh sửa mô tả về khuyến mại người sử dụng',
    ],
    'delete' => [
        'title' => 'Bạn có chắc chắn muốn xóa khuyến mại',
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề khuyến mại không được để trống.',
            'code' => 'Mã khuyến mại không được để trống.',
            'start' => 'Thời gian bắt đầu khuyến mại không được để trống.',
            'type_promotion' => 'Hình thức khuyến mại không được trống.',
            'discount' => 'Chiết khấu không được trống.',
            'product_promotion' => 'Đối tượng của hình thức khuyến mãi chưa được chọn.',
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