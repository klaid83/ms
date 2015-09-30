<?php

namespace Mod1;

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'mod1' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/mod1',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Mod1\Controller',
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
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Mod1\Controller\Index' => 'Mod1\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
	    'template_map' => array(
		    'mod1/test_template'          => __DIR__ . '/../view/test/test_template.phtml',
		    'mod1/test_template1'          => __DIR__ . '/../view/test/test_template1.phtml',
		    'mod1/test_template2'          => __DIR__ . '/../view/test/test_template2.phtml',
	    ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

	// чтобы пока немешалась
//	'doctrine' => array(
//		'driver' => array(
//			'mod1_entities' => array(
//				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
//				'cache' => 'array',
//				'paths' => array(__DIR__ . '/../src/Mod1/Entity')
//			),
//
//			'orm_default' => array(
//				'drivers' => array(
//					'Mod1\Entity' => 'mod1_entities'
//				)
//			)
//		)
//	),
);
