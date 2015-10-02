<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Этап торговой процедуры
 *
 * @ORM\Entity
 * @ORM\Table(name="stage_selection_1")
 */
class StageSelection1 extends Stage
{

	/**
	 * @ORM\Column(type="string")
	 */
	protected $specialNumber;

	public function setSpecialNumber($specialNumber)
	{
		$this->specialNumber = $specialNumber;
	}

	public function getSpecialNumber()
	{
		return $this->specialNumber;
	}


}