<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 *
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="country_id", type="integer")
	 */
	private $country_id;

	/**
	 *
	 * @ORM\Column(name="name", type="text")
	 */
	private $name;

	/**
	 *
	 * @ORM\Column(name="allias", type="text")
	 */
	private $allias;

	/**
	 *
	 * @ORM\Column(name="description", type="text")
	 */
	private $description;


	/**
	 * @ORM\OneToMany(targetEntity="City", mappedBy="country", cascade={"persist"})
	 */
	protected $cities;

	public function __construct()
	{
		$this->cities = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function setAllias($allias)
	{
		$this->allias = $allias;
	}

	public function getAllias()
	{
		return $this->allias;
	}

	public function setCities($cities)
	{
		$this->cities = $cities;
	}

	public function getCities()
	{
		return $this->cities;
	}

	public function setCountryId($country_id)
	{
		$this->country_id = $country_id;
	}

	public function getCountryId()
	{
		return $this->country_id;
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

}