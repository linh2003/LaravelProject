<?php
return [
    'module' => [
		[
			'title' => 'Manage Product',
			'icon' => 'archive',
			'name' => 'product',
			'sub' => [
				[
					'title' => 'Product',
					'route' => 'admin.product',
					'name' 	=> 'product',
				],
				[
					'title' => 'Product Catalogue',
					'route' => 'product.catalogue.create',
					'name' 	=> 'catalogue',
				],
				[
					'title' => 'Attribute Type',
					'route' => 'product.attributetype',
					'name' 	=> 'attributetype',
				],
				[
					'title' => 'Attribute',
					'route' => 'product.attribute',
					'name' 	=> 'attribute',
				]
			]
		],
		[
			'title' => 'Promotion manage',
			'icon' => 'gift',
			'name' => 'promotion',
			'sub' => [
				[
					'title' => 'Promotion',
					'route' => 'admin.promotion',
					'name' 	=> 'promotion',
				],
				// [
				// 	'title' => 'Sale',
				// 	'route' => 'admin.sale',
				// 	'name' 	=> 'sale',
				// ],
			]
		],
        [
			'title' => 'Users',
			'icon' => 'user',
			'name' => 'user',
			'sub' => [
				[
					'title' => 'All User',
					'route' => 'admin.user',
					'name' 	=> 'user',
				],
				[
					'title' => 'Role',
					'route' => 'user.role',
					'name' 	=> 'role',
				],
				[
					'title' => 'Permission',
					'route' => 'user.permission',
					'name' 	=> 'permission',
				],
				// [
				// 	'title' => 'Phòng ban',
				// 	'route' => 'admin.user',
				// 	'name' 	=> ['department','create','edit','delete'],
				// ],
			]
		],
        [
			'title' => 'Configuration',
			'icon' => 'cog',
			'name' => 'configuration',
			'sub' => [
				[
					'title' => 'Language',
					'route' => 'admin.language',
					'name' 	=> ['language','create','edit','delete'],
				],
				// [
				// 	'title' => 'Quản lý hệ thống',
				// 	'route' => 'admin.system',
				// 	'name' 	=> ['system','create','edit','delete'],
				// ],
				// [
				// 	'title' => 'Quản lý menu',
				// 	'route' => 'admin.menu',
				// 	'name' 	=> ['menu','create','edit','delete'],
				// ]
			]
		]
    ]
];