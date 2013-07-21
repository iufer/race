<?php

$config = array(
			'admin/race/add' => array(
							array(
								'field'=>'name',
								'label'=>'race name',
								'rules'=>'trim|required|min_length[5]|max_length[256]'
							),
							array(
								'field'=>'start_time',
								'label'=>'race date',
								'rules'=>'trim|required'
							),
							array(
								'field'=>'subtitle',
								'label'=>'race subtitle',
								'rules'=>'max_length[256]'
							),
							array(
								'field'=>'race_type_id',
								'label'=>'race type',
								'rules'=>'required|integer|greater_than[0]'
							),
							array(
								'field'=>'course_id',
								'label'=>'race course',
								'rules'=>'integer|greater_than[0]'
							)
						),													
			'admin/course/add' => array(
						array(
							'field'=>'name',
							'label'=>'course name',
							'rules'=>'trim|required|min_length[5]|max_length[256]'
						),
						array(
							'field'=>'url',
							'label'=>'course url',
							'rules'=>'trim|required|min_length[5]|max_length[128]'
						),
						array(
							'field'=>'miles',
							'label'=>'course miles',
							'rules'=>'numeric'
						),
						array(
							'field'=>'elevation',
							'label'=>'course elevation',
							'rules'=>'integer'
						),
						array(
							'field'=>'category_climb',
							'label'=>'course category',
							'rules'=>'is_natural'
						)
					),
			'admin/series/add' => array(
						array(
							'field'=>'name',
							'label'=>'series name',
							'rules'=>'trim|required|min_length[5]|max_length[256]'
						),
						array(
							'field'=>'date_start',
							'label'=>'start date',
							'rules'=>'required'
						),
						array(
							'field'=>'date_end',
							'label'=>'end date',
							'rules'=>'required'
						)					
					),
			'result/add' => array(
						array(
							'field'=>'rider_name',
							'label'=>'rider name',
							'rules'=>'trim|required'
						),
						array(
							'field'=>'rider_id',
							'label'=>'rider id',
							'rules'=>'trim|numeric|greater_than[0]'
						),
						array(
							'field'=>'rider_category_id',
							'label'=>'rider category',
							'rules'=>'required|numeric|greater_than[0]'
						)
					),
			'result/edit' => array(
						array(
							'field'=>'result_type_id',
							'label'=>'result type',
							'rules'=>'required|numeric|greater_than[0]'
						),
						array(
							'field'=>'data',
							'label'=>'result data',
							'rules'=>'trim'
						),
						array(
							'field'=>'rider_category_id',
							'label'=>'rider category',
							'rules'=>'required|numeric|greater_than[0]'
						)
					),					
			'admin/login' => array(
						array(
							'field'=>'email',
							'label'=>'user email',
							'rules'=>'trim|required|valid_email|max_length[256]'
						),
						array(
							'field'=>'password',
							'label'=>'user password',
							'rules'=>'trim|required|max_length[256]'
						)
					),
			'admin/rider/edit' => array(
						array(
							'field'=>'name',
							'label'=>'rider name',
							'rules'=>'trim|required|max_length[256]'
						),
						array(
							'field'=>'rider_category_id',
							'label'=>'rider category',
							'rules'=>'required|numeric|greater_than[0]'
						),
						array(
							'field'=>'public',
							'label'=>'rider public profile',
							'rules'=>'required|numeric'
						)
					),
			 'admin/sponsor/add' => array(
						array(
							'field'=>'name',
							'label'=>'sponsor name',
							'rules'=>'trim|required|max_length[256]'
						),
						array(
							'field'=>'link',
							'label'=>'sponsor link',
							'rules'=>'trim|required|prep_url|max_length[512]'
						),
						array(
							'field'=>'description',
							'label'=>'sponsor name',
							'rules'=>'trim'
						)
					),
			'admin/message/add' => array(
						array(
							'field'=>'title',
							'label'=>'message title',
							'rules'=>'trim|required|max_length[512]'
						),
						array(
							'field'=>'message',
							'label'=>'message',
							'rules'=>'required'
						)
					)
		);				