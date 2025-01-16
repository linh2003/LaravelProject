<?php
return [
	'module' => [
		[
			'title' => 'Sản phẩm',
			'icon' => 'archive',
			'name' => 'product',
			'sub' => [
				[
					'title' => 'Quản lý sản phẩm',
					'route' => 'admin.product',
					'name' 	=> 'product',
				],
				[
					'title' => 'Quản lý nhóm thuộc tính',
					'route' => 'product.attype',
					'name' 	=> 'attype',
				],
				[
					'title' => 'Quản lý thuộc tính',
					'route' => 'product.attribute',
					'name' 	=> 'attribute',
				],
				[
					'title' => 'Danh mục sản phẩm',
					'route' => 'product.catalogue.create',
					'name' 	=> 'productcat',
				],
			]
		],
		// [
		// 	'title' => 'Bài viết',
		// 	'icon' => 'thumb-tack',
		// 	'name' => 'post',
		// 	'sub' => [
		// 		[
		// 			'title' => 'Quản lý bài viết',
		// 			'route' => 'admin.user',
		// 			'name' 	=> ['post'],
		// 		],
		// 		[
		// 			'title' => 'Quản lý nhóm bài viết',
		// 			'route' => 'admin.user',
		// 			'name' 	=> ['postcatalogue','create','edit','delete'],
		// 		]
		// 	]
		// ],
		[
			'title' => 'Nhân sự',
			'icon' => 'user',
			'name' => 'user',
			'sub' => [
				[
					'title' => 'Quản lý nhân sự',
					'route' => 'admin.user',
					'name' 	=> ['user','create','edit','delete'],
				],
				[
					'title' => 'Vai trò',
					'route' => 'user.role',
					'name' 	=> ['role','create','edit','delete'],
				],
				[
					'title' => 'Phân quyền',
					'route' => 'user.permission',
					'name' 	=> ['permission','create','edit','delete'],
				],
				[
					'title' => 'Phòng ban',
					'route' => 'admin.user',
					'name' 	=> ['department','create','edit','delete'],
				],
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
					'name' 	=> ['language','create','edit','delete'],
				]
			]
		]
	]
];