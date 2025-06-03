<?php
return [
    'create' => [
        'title'         => 'Add new Catalogue Product',
        'description'   => 'Enter description about Catalogue Product',
        'tab'   => [
            'General Information',
            'SEO Configuration',
            'Album',
            'Video',
        ],
        'field' => [
            'name' => 'Name Catalogue Product',
            'parent' => [
                'label' => 'Parent Catalogue',
                'optionDefault' => 'Select Parent Catalogue',
            ],
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
            'nestable' => [
                'expand' => 'Expand All',
                'collapse' => 'Collapse All'
            ]
        ]
    ],
    'update' => [
        'title'         => 'Edit Product Catalogue',
        'description'   => 'Edit Product Catalogue description',
    ],
    'delete' => [
        'title' => 'Are you sure want to delete to Product Catalogue',
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Product Catalogue name is required.',
            'canonical' => [
                'required' => 'Machine name of Product Catalogue is required.',
                'unique' => 'Machine name of Product Catalogue already exists. Please use a value different!'
            ],
            'delChild' => 'Cannot delete because there are still subcategories!'
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