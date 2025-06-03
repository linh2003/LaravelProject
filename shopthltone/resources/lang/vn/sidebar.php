<?php
return [
    'module' => [
		[
			'title' => 'Quản lý sản phẩm',
			'icon' => 'archive',
			'name' => 'product',
			'sub' => [
				[
					'title' => 'Sản phẩm',
					'route' => 'admin.product',
					'name' 	=> 'product',
				],
				[
					'title' => 'Danh mục sản phẩm',
					'route' => 'product.catalogue.create',
					'name' 	=> 'catalogue',
				],
				[
					'title' => 'Nhóm thuộc tính',
					'route' => 'product.attributetype',
					'name' 	=> 'attributetype',
				],
				[
					'title' => 'Thuộc tính',
					'route' => 'product.attribute',
					'name' 	=> 'attribute',
				]
			]
		],
		[
			'title' => 'Quản lý khuyến mại',
			'icon' => 'gift',
			'name' => 'promotion',
			'sub' => [
				[
					'title' => 'Khuyến mại',
					'route' => 'admin.promotion',
					'name' 	=> 'promotion',
				],
				// [
				// 	'title' => 'Giảm giá',
				// 	'route' => 'admin.sale',
				// 	'name' 	=> 'sale',
				// ],
			]
		],
        [
			'title' => 'Nhân sự',
			'icon' => 'user',
			'name' => 'user',
			'sub' => [
				[
					'title' => 'Quản lý nhân sự',
					'route' => 'admin.user',
					'name' 	=> 'user',
				],
				[
					'title' => 'Vai trò',
					'route' => 'user.role',
					'name' 	=> 'role',
				],
				[
					'title' => 'Phân quyền',
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
			'title' => 'Cài đặt',
			'icon' => 'cog',
			'name' => 'configuration',
			'sub' => [
				[
					'title' => 'Quản lý ngôn ngữ',
					'route' => 'admin.language',
					'name' 	=> 'language',
				],
				[
					'title' => 'Quản lý hệ thống',
					'route' => 'admin.system',
					'name' 	=> 'system',
				],
				// [
				// 	'title' => 'Quản lý menu',
				// 	'route' => 'admin.menu',
				// 	'name' 	=> ['menu','create','edit','delete'],
				// ]
			]
		]
    ]
];