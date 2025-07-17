<?php
return [
	'module' => [
		[
			'title' => 'Công việc',
			'icon' => 'icon-edit-2',
			'name' => 'post',
			'sub' => [
				[
					'title' => 'Công việc chưa hoàn thành',
					'route' => 'user.view',
				],
				[
					'title' => 'Công việc đã hoàn thành',
					'route' => 'user.view',
				]
			]
		],
		[
			'title' => 'Nhân sự',
			'icon' => 'icon-users',
			'name' => 'users',
			'sub' => [
				[
					'title' => 'Quản lý nhân sự',
					'route' => 'user.view',
				],
				[
					'title' => 'Vai trò',
					'route' => 'role.view',
				],
				[
					'title' => 'Phân quyền',
					'route' => 'permission.view',
				],
				// [
				// 	'title' => 'Phòng ban',
				// 	'route' => 'user.view',
				// ],
			]
		],
		[
			'title' => 'Cài đặt',
			'icon' => 'icon-settings',
			'name' => 'config',
			'sub' => [
				[
					'title' => 'Quản lý ngôn ngữ',
					'route' => 'admin.language',
				],
				[
					'title' => 'Quản lý liên kết',
					'route' => 'menu.create',
				]
			]
		]
	]
];