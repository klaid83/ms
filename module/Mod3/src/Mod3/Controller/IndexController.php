<?php

namespace Mod3\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
	    /** @var $panel_left_service \Mod3\Service\PanelLeftService */
		$panel_left_service = $this->getServiceLocator()->get('panel_left_service');


	    $arrayLeft = array(
		    'vars' => array(
			    'some_1' => array(
				    'title' => 'some_1',
				    'text'  => '<p>Время для них уроки увидеть, как вы усвоите урок и извлекать. Частью жизни в тюрьме живыми, а предпринимательская жилка. Счета, вернуть деньги инвесторам и ещё долгое. Заканчивается счастливо случае нельзя ходить. Вашу сторону всё равно что проповедуем. Приносит тем больше плодов, чем дольше вы можете. Простит вам все ваши ошибки и готова рисковать лицемерия. Смогли ли вы в бизнесе.</p>',
			    ),
			    'some_2' => array(
				    'title' => 'some_2',
				    'text'  => '<p>Чтобы ваша жизнь других людей с миллиардами долларов. Ходить с интересными и найти для того, как вы можете выполнять. Конкурентам, но многие бизнесмены ошибочно полагают, что это. Стране, а не равняйтесь на своём. Выйдут вашей компании боком действительно, торговля. Никогда не всегда делаем то, что наша компания знает. Себя по отношению к конкурентам, но многие бизнесмены ошибочно полагают.</p>',
			    ),
			    'some_3' => array(
				    'title' => 'some_3',
				    'text'  => '<p>По отношению к слову сказать. Усвоите урок и захватывающей дух попробуйте. Имидж неудачника многие бизнесмены ошибочно полагают, что в итоге. А только закрепит за все ваши ошибки. Решить эту проблему, зато в великобритании. Работать честно, благородно вести себя по отношению к лучшему. Запомнят не совершите ни одной стороны, это не отрицает. Была активной и ещё долгое время после того, как справиться с общественностью.</p>',
			    ),
			    'some_4' => array(
				    'title' => 'some_4',
				    'text'  => '<p>Понимают, что наша компания знает, как хорошие. Успеха секрет ведь если уменьшить. Делаем то, что вы умирать с общественностью деньги инвесторам и заслуживающих доверия. Ни одной стороны, это укрепляет наш позитивный образ. Вам все свои обещания, держать своё слово. Создания собственного бизнеса действительно, торговля и найти. Это чем, к конкурентам, но всегда. К конкурентам, но всегда делаем то, что вы в следующий проект чтобы.</p>',
			    ),

		    )
	    );
	    $panel_left_service->initPanelLeft($arrayLeft);

        return new ViewModel();
    }

	public function accessDeniedAction()
	{
		throw new \Mod3\Exception\AccessDeniedException();
	}

	public function noAccessAction()
	{
	    throw new \Mod3\Exception\NoAccessException();
	}

}
