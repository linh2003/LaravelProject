<?php
return [
    'index' => [
        'title' => 'Manage Attribute',
        'tableHeading' => 'Attribute list',
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
            'No.' => ['class' => 'text-center input-checkbox-all-list-data'],
            'Attribute' => [],
            'Attribute Type' => [],
            'Status' => ['class' => 'text-center', 'width' => '100px'],
            'Action' => ['class' => 'text-center', 'width' => '100px'],
        ],
        'button' => [
            'publish' => 'Publish attribute',
            'unpublish' => 'UnPublish attribute',
        ]
    ],
    'create' => [
        'title'         => 'Create Attribute',
        'description'   => 'Description of Attribute',
        'tab'   => [
            'General Information',
            'SEO configuration',
            'Album',
        ],
        'field' => [
            'name' => 'Attribute name',
            'attribute_type' => 'Attribute Type',
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
        'title'         => 'Edit to Attribute',
        'description'   => 'Edit description to Attribute',
    ],
    'delete' => [
        'title' => 'Are you sure want to delete to Attribute',
    ],
    'filter' => [
        'button' => [
            'search' => 'Search',
            'perpage' => 'All',
        ]
    ],
    'message' => [
        'request' => [
            'name' => 'Attribute name is required.',
            'canonical' => [
                'required' => 'Machine name of Attribute is required.',
                'unique' => 'Machine name of Attribute already exists. Please use a value different!'
            ],
            'delete' => 'Cannot delete because there is still a module using this attribute!'
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