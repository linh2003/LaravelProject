<?php
namespace App\Classes;

class System
{
    public function config(){
        $data = [
            'general' => [
                'label' => 'Cài đặt chung',
                'description' => 'Cài đặt các thông tin của hệ thống như: Tên, email, logo, điện thoại, copyright',
                'value' => [
                    'name' => [
                        'label' => 'Tên hệ thống',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                    'logo' => [
                        'label' => 'Logo',
                        'input' => [
                            'type' => 'file',
                        ]
                    ],
                    'favicon' => [
                        'label' => 'Favicon',
                        'input' => [
                            'type' => 'file',
                        ]
                    ],
                    'email' => [
                        'label' => 'Email',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                    'phone' => [
                        'label' => 'Điện thoại',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                    'copyright' => [
                        'label' => 'Copyright',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                ]
            ],
            'seo' => [
                'label' => 'Cấu hình SEO',
                'description' => 'Cài đặt các thông tin để SEO hệ thống website lên Google tìm kiếm',
                'value' => [
                    'title' => [
                        'label' => 'Tiêu đề SEO',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                    'keyword' => [
                        'label' => 'Từ khóa SEO',
                        'input' => [
                            'type' => 'text', 'class' => 'form-control',
                        ]
                    ],
                    'content' => [
                        'label' => 'Mô tả SEO',
                        'input' => [
                            'type' => 'textarea', 'class' => 'form-control', 'rows' => 5
                        ]
                    ],
                    'image' => [
                        'label' => 'Ảnh SEO',
                        'input' => [
                            'type' => 'file',
                        ]
                    ],
                ]
            ]
        ];
        return $data;
    }
}
