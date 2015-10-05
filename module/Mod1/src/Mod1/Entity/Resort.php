<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resort
 *
 * @ORM\Entity
 * @ORM\Table(name="resort")
 */
class Resort
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="resort_id", type="integer")
	 */
	private $resort_id;

	/**
	 *
	 * @ORM\Column(name="name", type="text")
	 */
	private $name;

	/**
	 *
	 * @ORM\Column(name="description", type="text")
	 */
	private $description;

	/**
	 * @ORM\ManyToOne(targetEntity="City", inversedBy="resorts", cascade={"persist"})
	 * @ORM\JoinColumn(name="city_id", referencedColumnName="city_id", unique=false, nullable=false)
	 */
	protected $city;

	public function setCity($city)
	{
		$this->city = $city;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setResortId($resort_id)
	{
		$this->resort_id = $resort_id;
	}

	public function getResortId()
	{
		return $this->resort_id;
	}

}