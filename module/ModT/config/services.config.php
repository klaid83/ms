<?php

use Zend\Log\Logger;
use Zend\Log\Writer\Stream;


return array(
		'invokables' => array(
			'Listener.ExceptionStrategy' => 'ModT\Listener\ExceptionStrategy',
		),
		'abstract_factories' => array(),
		'factories' => array(
			'menu_service' 	=> 'ModT\Service\MenuServiceFactory',
			'Logger' => function ($sm) {
				$filename = 'log_' . date('F') . '.txt';
				$log = new Logger();

				if(!is_dir('./data/logs')){
					mkdir('./data/logs');
					chmod('./data/logs', 0777);
				}

				$writer = new Stream('./data/logs/' . $filename);
				$log->addWriter($writer);
				return $log;
			}
		),
	);