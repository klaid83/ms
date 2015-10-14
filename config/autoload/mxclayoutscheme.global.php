<?php

return array(
	'mxclayoutscheme' => array(
		'options' => array(
			'zf2-standard' => array(
				'mca_layouts' => array(
					'options' => array(
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',
					),
				),
				'route_layouts' => array(
					'options' => array(
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',
					),
				),
				'http_status_layouts' => array(
					'options'  => array(
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',
					),
				),
				'error_layouts' => array(
					'options'  => array(

					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout2',
					),
				),
			),
		),
		'defaults' => array(
			'active_scheme'          => 'zf2-standard',
			'enable_mca_layouts'     => true,
			'enable_route_layouts'   => true,
			'enable_error_layouts'   => true,
			'enable_status_layouts'  => true,
		),
	),
);