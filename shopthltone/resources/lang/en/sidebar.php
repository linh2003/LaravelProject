<?php
return [
	'module' => [
		[
			'title' => 'All Product',
			'icon' => 'archive',
			'name' => 'product',
			'sub' => [
				[
					'title' => 'Product',
					'route' => 'admin.product',
					'name' 	=> 'product',
				],
				[
					'title' => 'Attribute Type',
					'route' => 'product.attype',
					'name' 	=> 'attype',
				],
				[
					'title' => 'Attribute',
					'route' => 'product.attribute',
					'name' 	=> 'attribute',
				],
				[
					'title' => 'Product Catalogue',
					'route' => 'product.catalogue',
					'name' 	=> 'productcat',
				],
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
					'route' => 'admin.user',
					'name' 	=> 'role',
				],
				[
					'title' => 'Permission',
					'route' => 'admin.user',
					'name' 	=> 'permission',
				],
				[
					'title' => 'Department',
					'route' => 'admin.user',
					'name' 	=> 'department',
				],
			]
		],
		[
			'title' => 'Posts',
			'icon' => 'thumb-tack',
			'name' => 'post',
			'sub' => [
				[
					'title' => 'All Posts',
					'route' => 'admin.user',
					'name' 	=> 'post',
				],
				[
					'title' => 'Post Catalogues',
					'route' => 'admin.user',
					'name' 	=> 'postcatalogue',
				]
			]
		],
		[
			'title' => 'Configuration',
			'icon' => 'cog',
			'name' => 'configuration',
			'sub' => [
				[
					'title' => 'Languages',
					'route' => 'admin.language',
					'name' 	=> 'language',
				]
			]
		]
	]
];