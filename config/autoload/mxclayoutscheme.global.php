<?php

return array(
	'mxclayoutscheme' => array(
		'options' => array(
			'zf2-standard' => array(
				'mca_layouts' => array(
					'options' => array(
					),
					'defaults' => array(
						'layout'      => 'layout/layout',
					),
				),
				'route_layouts' => array(
					'options' => array(
					),
					'defaults' => array(
						'layout'      => 'layout/layout',
					),
				),
				'http_status_layouts' => array(
					'options'  => array(
					),
					'defaults' => array(
						'layout'      => 'layout/layout',
					),
				),
				'error_layouts' => array(
					'options'  => array(

					),
					'defaults' => array(
						'layout'      => 'layout/layout',
					),
				),
			),
			'my-scheme' => array(
				'mca_layouts' => array( // Rules for module, controller, action get applied for layout selection. Default: true
					'options' => array(
						'Mod3' => array(
							'layout'     => 'mod3/mod3_layout',
							'panelLeft'  => 'mod3/panelLeft',    // теперь только здесь будет вставляться
							'panelRight' => 'mod3/panelRight',   // теперь только здесь будет вставляться
						),
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout4', // здесь невставится panelLeft в лайаут

					),
				),
				'route_layouts' => array( // Rules for module, controller, action get applied for layout selection. Default: true
					'options' => array(
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',      //
//						'panelLeft' => 'mod3/test_template2',      // везде будет вставляться шаблон в лайаут
					),
				),
				'http_status_layouts' => array( // Rules based on status code get applied for layout selection on dispatch errors. Default: true
					'options'  => array(
					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',
					),
				),
				'error_layouts' => array( // Rules based on event error code get applied for layout selection on dispatch errors. Default: true
					'options'  => array(

					),
					'defaults' => array(
						'layout'      => 'mod3/test_layout1',
					),
				),
			),
		),
		'defaults' => array(
			'active_scheme'          => 'my-scheme',
			'enable_mca_layouts'     => true,
			'enable_route_layouts'   => true,
			'enable_error_layouts'   => true,
			'enable_status_layouts'  => true,
		),
	),
);