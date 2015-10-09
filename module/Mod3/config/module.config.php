<?php

namespace Mod3;

return array(
    'router' => array(
        'routes' => array(
            'mod3' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/mod3',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Mod3\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Mod3\Controller\Index' => 'Mod3\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
	    'template_map' => array(
		    'mod3/test_template'   => __DIR__ . '/../view/view_test/test_template.phtml',
		    'mod3/test_template1'  => __DIR__ . '/../view/view_test/test_template1.phtml',
		    'mod3/test_template2'  => __DIR__ . '/../view/view_test/test_template2.phtml',
		    'mod3/test_template3'  => __DIR__ . '/../view/view_test/test_template3.phtml',
		    'mod3/test_template4'  => __DIR__ . '/../view/view_test/test_template4.phtml',
		    'mod3/test_layout'     => __DIR__ . '/../view/view_test/test_layout.phtml',
		    'mod3/test_layout1'    => __DIR__ . '/../view/view_test/test_layout1.phtml',
		    'mod3/test_layout2'    => __DIR__ . '/../view/view_test/test_layout2.phtml',
		    'mod3/test_layout3'    => __DIR__ . '/../view/view_test/test_layout3.phtml',
		    'mod3/test_layout4'    => __DIR__ . '/../view/view_test/test_layout4.phtml',
		    'mod3/access_denied'   => __DIR__ . '/../view/view_test/access_denied.phtml',
		    'mod3/no_access'       => __DIR__ . '/../view/view_test/no_access.phtml',
	    ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

//	'doctrine' => array(
//		'driver' => array(
//			'mod3_entities' => array(
//				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//				'cache' => 'array',
//				'paths' => array(__DIR__ . '/../src/Mod3/Entity')
//			),
//
//			'orm_default' => array(
//				'drivers' => array(
//					'Mod3\Entity' => 'mod3_entities'
//				)
//			)
//		)
//	),
);
