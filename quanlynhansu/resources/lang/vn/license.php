<?php
return [
	'create' => [
		'title' => 'Tạo đơn xin',
		'note' => '- <b class="text-danger">Lưu ý</b>: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc!',
	],
	'update' => [
		'title' => 'Chỉnh sửa đơn xin',
	],
	'message' => [
		'request' => [
			'start_date' => 'Ngày bắt đầu đang trống',
			'end_date' => [
				'required' => 'Ngày kết thúc đang trống',
				'after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
			]
		]
	],
	'store' => [
		'field' => [
			'name' => 'Nhân sự',
			'approver' => 'Người duyệt',
			'type' => 'Loại đơn',
			'status' => 'Trạng thái',
			'start_date' => 'Ngày bắt đầu',
			'end_date' => 'Ngày kết thúc',
			'reason' => 'Lý do',
			'unit' => [
				'label' => 'Hình thức',
				'value' => [
					1 => 'Một ngày',
					2 => 'Nhiều ngày',
				]
			],
			'duration' => [
				'label' => 'Khoảng thời gian',
				'value' => [
					1 => 'Cả ngày',
					2 => 'Buổi sáng',
					3 => 'Buổi chiều',
				]
			]
		]
	],
	'index' => [
		'title' => 'Danh sách đơn xin',
		'column' => [
			'TT' => ['class' => 'text-center'],
			'Nhân sự' => [],
			'Loại' => ['class' => 'text-center'],
			'Tình trạng' => ['class' => 'text-center'],
			'Thao tác' => ['class' => 'text-center'],
		]
	],
	'breadcrumb' => 'Quản lý đơn xin'
];