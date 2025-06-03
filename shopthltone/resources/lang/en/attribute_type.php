<?php
return [
    'index' => [
        'title' => 'Manage Attribute Type',
        'tableHeading' => 'Attribute Type list',
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
            'No.' => ['class' => 'text-center'],
            'Attribute Type' => [],
            'Status' => ['class' => 'text-center', 'width' => '100px'],
            'Action' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'publish' => 'Publish attribute type',
            'unpublish' => 'UnPublish attribute type',
        ]
    ],
    'create' => [
        'title'         => 'Create Attribute Type',
        'description'   => 'Description of Attribute Type',
        'tab'   => [
            'General Information',
            'SEO configuration',
            'Album',
        ],
        'field' => [
            'name' => 'Attribute Type name',
            'description' => 'Description',
            'content' => 'Content',
            'meta_title' => 'Title SEO',
            'meta_keyword' => 'Keyword SEO',
            'meta_description' => 'Description SEO',
            'canonical' => 'Canonical',
            'publish' => 'Publish',
            'follow' => 'Follow',
        ],
        'modal' => [
            'title' => 'Enter SEO title',
            'description' => 'Enter content description',
        ]
    ],
    'update' => [
        'title'         => 'Edit to Attribute Type',
        'description'   => 'Edit description to Attribute Type',
    ],
    'delete' => [
        'title' => 'Are you sure want to delete to Attribute Type',
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Attribute Type name is required.',
            'canonical' => [
                'required' => 'Machine name of Attribute Type is required.',
                'unique' => 'Machine name of Attribute Type already exists. Please use a value different!'
            ],
            'delete' => 'Cannot delete because it still contains child attribute!'
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