<?php
return [
	'module' => [
		[
			'title' => 'Users',
			'icon' => 'icon-users',
			'name' => 'users',
			'sub' => [
				[
					'title' => 'All User',
					'route' => 'admin.user',
				],
				[
					'title' => 'Role',
					'route' => 'admin.user',
				],
				[
					'title' => 'Permission',
					'route' => 'admin.user',
				],
				[
					'title' => 'Department',
					'route' => 'admin.user',
				],
			]
		],
		[
			'title' => 'Posts',
			'icon' => 'icon-edit-1',
			'name' => 'post',
			'sub' => [
				[
					'title' => 'All Posts',
					'route' => 'admin.user',
				],
				[
					'title' => 'Post Catalogues',
					'route' => 'admin.user',
				]
			]
		],
		[
			'title' => 'Configuration',
			'icon' => 'icon-settings',
			'name' => 'config',
			'sub' => [
				[
					'title' => 'Languages',
					'route' => 'admin.language',
				]
			]
		]
	]
];