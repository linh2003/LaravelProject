<?php
return [
    'index' => [
        'title' => 'Manage Product',
        'tableHeading' => 'Product List',
        'tableBody' => [
            'catalogue' => 'Catalogue',
            'code' => 'Code',
        ],
        'counter' => 'Showing',
        'columnHeading' => [
            'checkbox' => [
                'width' => '15px',
                'input' => [
                    'type' => 'checkbox',
                    'class' => 'input-checkbox input-checkbox-all-product-list',
                    'name' => 'checkAll',
                    'id' => 'checkAll',
                    'value' => '',
                ]
            ],
            'No.' => ['class' => 'text-center'],
            'Product' => [],
            'Quantity' => ['width' => '100px', 'class' => 'text-center'],
            'Price' => [],
            'Status' => ['class' => 'text-center', 'width' => '100px'],
            'Action' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'create' => 'Add new',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'delete_all' => 'Delete all',
            'publish' => 'Publish product',
            'unpublish' => 'UnPublish product',
        ]
    ],
    'create' => [
        'title'         => 'Add new Product',
        'description'   => 'Enter description Product',
        'tab'   => [
            'General Information',
            'SEO Configuration',
            'Album',
            'Variant product',
        ],
        'field' => [
            'name' => 'Name Product',
            'product_catalogue' => 'Product Catalogue Primary',
            'catalogues' => [
                'title' => 'Product Catalogue Secondary',
                'label' => 'Select Product Catalogue',
            ],
            'aside' => [
                'label' => 'Information',
                'code' => 'Code',
                'quantity' => 'Quantity',
                'price' => 'Price',
            ],
            'image' => 'Image',
            'description' => 'Description',
            'content' => 'Content',
            'meta_title' => 'SEO title',
            'meta_keyword' => 'SEO keyword',
            'meta_description' => 'SEO description',
            'canonical' => 'Canonical',
            'publish' => 'Publish',
            'follow' => 'Follow',
        ],
        'modal' => [
            'title' => 'Enter SEO title',
            'description' => 'Enter description',
        ]
    ],
    'update' => [
        'title'         => 'Edit Product',
        'description'   => 'Edit Product description',
    ],
    'delete' => [
        'title' => 'Are you sure want to delete to Product',
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'variant' => [
        'description' => 'Allow users to create different variations of a product. For example, when selling clothes, there can be different colors and sizes. Each variation is represented as a row in the version list below.',
        'checkbox' => 'This product have many variant',
        'variantLabelLeft' => 'Select Attribute Type',
        'variantLabelCenter' => 'Select Attribute',
        'buttonAdd' => 'Add new variant',
        'script' => [
            'labelListVariant' => 'Variant list',
            'defaultAttributeType' => 'Select Attribute Type',
            'ajaxText' => 'Enter two character to search',
            'headTableImage' => 'Image',
            'headTableQuantity' => 'Quantity',
            'headTablePrice' => 'Price',
            'titleTableForm' => 'Update variant information',
            'cancelUpdateTableForm' => 'Cancel',
            'saveUpdateTableForm' => 'Save',
            'checkboxInventory' => 'Inventory',
            'inputLabelQuantity' => 'Quantity',
            'inputLabelPrice' => 'Price',
            'alert' => 'Please enter Price product field!',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Product name is required.',
            'catalogue' => 'Product catalogue is required.',
            'canonical' => [
                'required' => 'URL of Product is required.',
                'unique' => 'URL of Product already exists. Please use a value different!'
            ]
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