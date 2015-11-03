<?php

namespace ModT;

return array(
    'router' => array(
        'routes' => array(
//            'modt' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    'route'    => '/modt',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'ModT\Controller',
//                        'controller'    => 'Index',
//                        'action'        => 'index',
//                    ),
//                ),
//                'may_terminate' => true,
//                'child_routes' => array(
//                    'default' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:controller[/:action]]',
//                            'constraints' => array(
//                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
//                            'defaults' => array(
//                            ),
//                        ),
//                    ),
//                ),
//            ),
	        'directory' => array(
		        'type'    => 'segment',
		        'options' => array(
			        'route'    => '/directory/',
			        'defaults' => array(
				        '__NAMESPACE__' => 'ModT\Controller',
				        'controller'    => 'Index',
				        'action'        => 'index',
			        ),
		        ),
	        ),
	        'country' => array(
		        'type' => 'Zend\Mvc\Router\Http\Segment',
		        'options' => array(
			        'route' => '/directory/:country',
			        'constraints' => array(
				        'country' => '[a-zA-Z][a-zA-Z0-9_-]*',
			        ),
			        'defaults' => array(
				        '__NAMESPACE__' => 'ModT\Controller',
				        'controller'    => 'Index',
				        'action'        => 'country',
			        )
		        )
	        ),
			'city' => array(
		        'type' => 'Zend\Mvc\Router\Http\Segment',
		        'options' => array(
			        'route' => '/directory/:country/:city',
			        'constraints' => array(
				        'country' => '[a-zA-Z][a-zA-Z0-9_-]*',
				        'city'    => '[a-zA-Z][a-zA-Z0-9_-]*',
			        ),
			        'defaults' => array(
				        '__NAMESPACE__' => 'ModT\Controller',
				        'controller'    => 'Index',
				        'action'        => 'city',
			        )
		        )
	        ),
	        'city_form' => array(
		        'type' => 'Zend\Mvc\Router\Http\Segment',
		        'options' => array(
			        'route' => '/city_form/',
			        'defaults' => array(
				        '__NAMESPACE__' => 'ModT\Controller',
				        'controller'    => 'City',
				        'action'        => 'index',
			        )
		        )
	        ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'ModT\Controller\Index' => 'ModT\Controller\IndexController',
            'ModT\Controller\City' => 'ModT\Controller\CityController',
        ),
    ),
    'view_manager' => array(
	    'template_map' => array(
		    'modt/menu_city'       => __DIR__ . '/../view/view_dop/menu_city.phtml',
		    'modt/menu_country'    => __DIR__ . '/../view/view_dop/menu_country.phtml',
		    'modt/panelLeft'       => __DIR__ . '/../view/view_dop/panel_left.phtml',
		    'modt/panelRight'      => __DIR__ . '/../view/view_dop/panel_right.phtml',
		    'modt/layout'          => __DIR__ . '/../view/view_dop/layout.phtml',
		    'modt/countries'       => __DIR__ . '/../view/view_dop/countries.phtml',
		    'modt/country'         => __DIR__ . '/../view/view_dop/country.phtml',
		    'modt/city'            => __DIR__ . '/../view/view_dop/city.phtml',
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
