<?php

$config['site_nav'] = array(
	array(
		'route'=>'',
		'title'=> setting('site_name'),
		'icon'=>'i_house'
	),
	array(
		'route'=>'race',
		'title'=>'Races',
		'icon'=>'i_running_man'
	),
	array(
		'route'=>'course',
		'title'=>'Courses',
		'icon'=>'i_sign_post'
	),
	array(
		'route'=>'series',
		'title'=>'Series',
		'icon'=>'i_sign_post'
	),
	array(
		'route'=>'rider',
		'title'=>'Riders',
		'icon'=>'i_male_countour'
	)
);


$config['site_admin_nav'] = array(
	array(
		'route'=>'admin',
		'title'=>'Dashboard',
		'icon'=>'icon-th'
	),
	array(
		'route'=>'admin/race',
		'title'=>'Races',
		'icon'=>'icon-chevron-right',
		'sub'=> array(
					array(
						'route'=>'admin/race',
						'title'=>'Race Index',
						'icon'=>'icon-th-list',
						'match'=>array('admin\/race$', 'admin\/race\/edit.+')
					),
					array(
						'route'=>'admin/race/add',
						'title'=>'New Race',
						'icon'=>'icon-plus'
					),
					array(
						'route'=>'admin/race/settings',
						'title'=>'Settings',
						'icon'=>'icon-cog'
					)
				)
	),
	array(
		'route'=>'admin/course',
		'title'=>'Courses',
		'icon'=>'icon-chevron-right',			
		'sub'=> array(
					array(
						'route'=>'admin/course',
						'title'=>'Course Index',
						'match'=>array('admin\/course$', 'admin\/course\/edit.+')
					),
					array(
						'route'=>'admin/course/add',
						'title'=>'New Course'
					)
				)
	),
	array(
		'route'=>'admin/series',
		'title'=>'Series',
		'icon'=>'icon-chevron-right',
		'sub'=> array(
					array(
						'route'=>'admin/series',
						'title'=>'Series Index',
						'icon'=>'i_house',
						'match'=>array('admin\/series$', 'admin\/series\/edit.+')
					),
					array(
						'route'=>'admin/series/add',
						'title'=>'New Series',
						'icon'=>'i_house'
					)
			)
	),
	array(
		'route'=>'admin/rider',
		'title'=>'Riders',
		'icon'=>'icon-chevron-right',
		'match'=>'admin\/rider.+',
		'sub'=> array(
			array(
				'route'=>'admin/rider',
				'title'=>'Rider Index',
				'icon'=>'i_house',
				'match'=>array('admin\/rider$', 'admin\/rider\/edit.+')
			),
			array(
				'route'=>'admin/rider/settings',
				'title'=>'Settings',
				'icon'=>'i_house'
			)
		)
	),
	array(
		'route'=>'admin/message',
		'title'=>'Messages',
		'icon'=>'icon-chevron-right',
		'sub'=> array(
					array(
						'route'=>'admin/message',
						'title'=>'Message Index',
						'icon'=>'i_house',
						'match'=>array('admin\/message$', 'admin\/message\/edit.+')
					),
					array(
						'route'=>'admin/message/add',
						'title'=>'New Message',
						'icon'=>'i_house'
					)
				)
	),
	array(
		'route'=>'admin/sponsor',
		'title'=>'Sponsors',
		'icon'=>'icon-chevron-right',
		'sub'=> array(
			array(
				'route'=>'admin/sponsor',
				'title'=>'Sponsor Index',
				'icon'=>'i_house',
				'match'=>array('admin\/sponsor$', 'admin\/sponsor\/edit.+')
			),
			array(
				'route'=>'admin/sponsor/add',
				'title'=>'New Sponsor',
				'icon'=>'i_house',
				'match'=>'admin\/sponsor\/add'
			)
		)
	),
	array(
		'route'=>'admin/user',
		'title'=>'Users',
		'icon'=>'icon-chevron-right',
		'sub'=> array(
			array(
				'route'=>'admin/user',
				'title'=>'User Index',
				'match'=>array('admin\/user$','admin\/user\/edit.+')
			),
			array(
				'route'=>'admin/user/add',
				'title'=>'New User',
				'match'=>'admin\/user\/add'
			)
		)
	),
	array(
		'route'=>'admin/site/settings',
		'title'=>'Settings'
	),
	array(
		'route'=>'admin/logout',
		'title'=>'Logout'
	)
);