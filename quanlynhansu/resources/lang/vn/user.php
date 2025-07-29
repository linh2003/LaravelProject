<?php
return [
    'index' => [
        'title' => 'Quản lý nhân sự',
        'tableHeading' => 'Danh sách nhân sự',
        'column' => [
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
            'Nhân sự' => [],
            'Thông tin chung' => [],
            'Vai trò' => ['class' => 'text-center', 'width' => '150px'],
            'Tình trạng' => ['class' => 'text-center'],
            'Đăng nhập lần cuối' => ['class' => 'text-center', 'width' => '100px'],
            'Thao tác' => ['class' => 'text-center'],
        ],
        'changerole' => [
            'title' => 'Vai trò người dùng',
            'message' => [
                'success' => 'Thay đổi vai trò thành công',
                'error' => 'Thay đổi vai trò thất bại. Vui lòng thử lại!'
            ]
        ],
        'button' => [
            'publish' => 'Mở khóa người dùng',
            'unpublish' => 'Khóa người dùng',
            'changerole' => 'Thay đổi vai trò',
        ],
    ],
    'create' => [
        'title' => 'Thêm mới nhân sự',
        'tabs' => [
            'generalInfor' => [
                'icon' => 'icofont-users',
                'label' => 'Thông tin cơ bản'
            ], 
            'personalInfor' => [
                'icon' => 'icofont-ui-user',
                'label' => 'Thông tin cá nhân'
            ], 
            'salary'=> [
                'icon' => 'icofont-money',
                'label' => 'Lương + phụ cấp'
            ]
        ],
        'field' => [
            'name' => 'Họ Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'department' => 'Phòng ban',
            'cccd' => 'CCCD',
            'status' => 'Tình trạng',
            'gender' => [
                'label' => 'Giới tính',
                'female' => 'Nữ',
                'male' => 'Nam',
            ],
            'birthday' => 'Ngày sinh',
            'dayofjoin' => 'Ngày vào làm',
            'dayofleave' => 'Ngày nghỉ làm',
            'dayoffnumber' => 'Số ngày nghỉ phép',
            'address' => 'Địa chỉ',
            'salary' => 'Lương cơ bản',
            'bonus' => 'Phụ cấp',
            'bhxh' => 'Số BHXH',
            'province' => 'Tỉnh (Thành phố)',
            'district' => 'Quận (Huyện)',
            'ward' => 'Phường (Xã)',
            'social' => [
                'label' => 'Social',
                'option' => [
                    [
                        'icon' => 'icofont-social-facebook',
                        'title' => 'Facebook'
                    ],
                    [
                        'icon' => 'icofont-social-twitter',
                        'title' => 'Twitter'
                    ],
                    [
                        'icon' => 'icofont-social-instagram',
                        'title' => 'Instagram'
                    ],
                    [
                        'icon' => 'icofont-brand-linkedin',
                        'title' => 'Linkedin'
                    ],
                ]
            ],
        ]
    ],
    'update' => [
        'title' => 'Chỉnh sửa nhân sự'
    ],
    'message' => [
        'request' => [
            'name' => 'Tên nhân sự không được để trống.',
            'email' => [
                'required' => 'Email không được trống.',
                'unique' => 'Email đã tồn tại. Vui lòng nhập giá trị khác!'
            ],
            'password' => [
                'required' => 'Mật khẩu không được trống.',
                'min' => 'Mật khẩu phải chứa ít nhất 5 ký tự.',
            ],
            'phone' => [
                'required' => 'Số điện thoại không được trống.',
                'unique' => 'Số điện thoại đã tồn tại. Vui lòng nhập giá trị khác!'
            ]
        ],
    ]
];