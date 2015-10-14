<?php

return array(
		'invokables' => array(
			'Listener.GuardExceptionStrategy' => 'Mod3\Listener\GuardExceptionStrategy',
		),
		'abstract_factories' => array(),
		'factories' => array(
			'mxc_layoutscheme_service' 	=> 'Mod3\Service\LayoutSchemeServiceFactory'
		),
	);