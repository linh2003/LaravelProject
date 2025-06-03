<?php
return [
    'index' => [
        'title' => 'Quản lý sản phẩm',
        'tableHeading' => 'Danh sách sản phẩm',
        'tableBody' => [
            'catalogue' => 'Danh mục',
            'code' => 'Mã',
        ],
        'counter' => 'Hiển thị',
        'columnHeading' => [
            'checkbox' => [
                'width' => '15px',
                'input' => [
                    'type' => 'checkbox',
                    'class' => 'input-checkbox input-checkbox-all-list-data',
                    'name' => 'checkAll',
                    'id' => 'checkAll',
                    'value' => '',
                ]
            ],
            'TT' => ['class' => 'text-center'],
            'Sản phẩm' => [],
            'Số lượng' => ['width' => '100px', 'class' => 'text-center'],
            'Giá' => ['class' => 'text-right'],
            'Trạng thái' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'create' => 'Thêm mới',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'delete_all' => 'Xóa tất cả',
            'publish' => 'Mở sản phẩm',
            'unpublish' => 'Khóa sản phẩm',
        ]
    ],
    'create' => [
        'title'         => 'Thêm mới sản phẩm',
        'description'   => 'Nhập mô tả về sản phẩm',
        'tab'   => [
            'Thông tin chung',
            'Cấu hình SEO',
            'Bộ sưu tập ảnh',
            'Phiên bản sản phẩm',
        ],
        'field' => [
            'name' => 'Tên sản phẩm',
            'product_catalogue' => 'Danh mục chính',
            'catalogues' => [
                'title' => 'Danh mục phụ',
                'label' => 'Chọn Danh mục',
            ],
            'aside' => [
                'label' => 'Thông tin',
                'code' => 'Mã sản phẩm',
                'quantity' => 'Số lượng',
                'price' => 'Giá',
            ],
            'image' => 'Hình ảnh sản phẩm',
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
        'title'         => 'Chỉnh sửa sản phẩm',
        'description'   => 'Chỉnh sửa mô tả về sản phẩm người sử dụng',
    ],
    'delete' => [
        'title' => 'Bạn có chắc chắn muốn xóa sản phẩm',
    ],
    'filter' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'perpage' => 'Tất cả',
        ]
    ],
    'variant' => [
        'description' => 'Cho phép người dùng tạo ra các biến thể khác nhau của sản phẩm. Ví dụ bán quần áo sẽ có các màu sắc, kích thước khác nhau. Mỗi phiên bản là một dòng trong mục danh sách phiên bản phía dưới.',
        'checkbox' => 'Sản phẩm này có nhiều biến thể',
        'variantLabelLeft' => 'Chọn nhóm thuộc tính',
        'variantLabelCenter' => 'Chọn thuộc tính',
        'buttonAdd' => 'Thêm phiên bản',
        'script' => [
            'labelListVariant' => 'Danh sách phiên bản',
            'defaultAttributeType' => 'Chọn Loại thuộc tính',
            'ajaxText' => 'Nhập 2 ký tự để tìm kiếm',
            'headTableImage' => 'Hình ảnh',
            'headTableQuantity' => 'Số lượng',
            'headTablePrice' => 'Giá',
            'titleTableForm' => 'Cập nhật thông tin phiên bản',
            'cancelUpdateTableForm' => 'Hủy bỏ',
            'saveUpdateTableForm' => 'Lưu',
            'checkboxInventory' => 'Tồn kho',
            'inputLabelQuantity' => 'Số lượng',
            'inputLabelPrice' => 'Giá',
            'alert' => 'Vui lòng nhập Giá sản phẩm!',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Tiêu đề sản phẩm không được để trống.',
            'catalogue' => 'Danh mục sản phẩm không được để trống.',
            'canonical' => [
                'required' => 'Đường dẫn sản phẩm không được trống.',
                'unique' => 'Đường dẫn sản phẩm đã tồn tại. Vui lòng nhập giá trị khác!'
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