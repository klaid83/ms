<?php

namespace Mod2;

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'mod2' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/mod2',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Mod2\Controller',
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
            'Mod2\Controller\Index' => 'Mod2\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
	    'template_map' => array(
		    'mod2/test_template'          => __DIR__ . '/../view/test/test_template.phtml',
		    'mod2/test_template1'          => __DIR__ . '/../view/test/test_template1.phtml',
		    'mod2/test_template2'          => __DIR__ . '/../view/test/test_template2.phtml',
		    'mod2/menu'                    => __DIR__ . '/../view/test/menu_view.phtml',
		    'mod2/404'                     => __DIR__ . '/../view/test/page404.phtml',
		    'mod2/403'                     => __DIR__ . '/../view/test/page403.phtml',
		    'layout/new_layout'            => __DIR__ . '/../view/layout/layout.phtml',
		    'layout/app_layout'            => __DIR__ . '/../view/layout/layout_app.phtml',
	    ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
	    'strategies' => array(
		    'ViewJsonStrategy',
	    ),
    ),
	// или сюда
//	'view_helpers' => array(
//		'invokables'=> array(
//			'test_helper' => 'Mod2\View\Helper\Testhelper'
//		)
//	),
);
