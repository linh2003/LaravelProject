<?php
return [
    'index' => [
        'title' => 'Promotion manage',
        'tableHeading' => 'Promotion',
        'counter' => 'Showing',
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
            'Promotion' => [],
            'Time' => ['class' => 'text-center'],
            'Status' => ['class' => 'text-center', 'width' => '100px'],
            'Action' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'label' => [
            'code' => 'Code',
            'start' => 'Start',
            'end' => 'to',
            'due' => 'Due',
        ],
        'button' => [
            'publish' => 'Publish promotion',
            'unpublish' => 'UnPublish promotion',
        ]
    ],
    'create' => [
        'title' => 'Add new promotion',
        'titleBoxLeft' => 'Promotion Information',
        'titleBoxRight' => 'Time apply',
        'titleBoxRightBottom' => 'Publish',
        'field' => [
            'name' => 'Name promotion',
            'code' => 'Code promotion',
            'description' => 'Description promotion',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'type' => [
                'label' => 'Promotion with',
                'option' => [
                    'none' => 'Select promotion type',
                    'value_product' => 'Product value',
                    'product' => 'Product',
                    // 'invoice' => 'Invoice',
                ]
            ],
            'type_option' => [
                'value_product' => [
                    'begin' => 'Begin Price',
                    'end' => 'End Price',
                    'discountValue' => 'Discount',
                    'discount' => [
                        'cash' => '$',
                        'percent' => '%',
                    ],
                    'button' => 'Add new',
                    'error' => [
                        'required' => 'Field is required!',
                        'conflict' => 'Begin condition is must less than end condition!',
                        'invalid' => 'Invalid condition range. Please enter value again!',
                    ]
                ],
                'product' => [
                    'radio' => ['Product', 'Product Catalogue'],
                    'name' => [
                        'product' => 'Product',
                        'productcatalogue' => 'Product Catalogue',
                    ],
                    'search' => 'Search ...',
                    'modal' => [
                        'close' => 'Close',
                        'save' => 'Save',
                        'quantity' => 'Quantity: ',
                        'price' => 'price: ',
                        'sku' => 'Sku: ',
                    ]
                ]
            ]
        ]
    ],
    'update' => [
        'title'         => 'Edit to Promotion',
        'description'   => 'Edit description to Promotion',
    ],
    'delete' => [
        'title' => 'Are you sure want to delete to Promotion',
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Promotion name is required.',
            'code' => 'Promotion code is required.',
            'start' => 'Promotion start date is required.',
            'type_promotion' => 'Promotion type is required.',
            'discount' => 'Discount is required.',
            'product_promotion' => 'Object of Promotion is required.',
        ],
        'create' => [
            'success' => 'Insert new record successfully!',
            'error' => 'Insert new recored failed!. Please try again!',
        ],
        'update' => [
            'success' => 'Update record successfully!',
            'error' => 'Update recored failed!. Please try again!',
        ],
        'delete' => [
            'success' => 'Delete record successfully!',
            'error' => 'Delete recored faild!. Please try again!',
        ]
    ]
];