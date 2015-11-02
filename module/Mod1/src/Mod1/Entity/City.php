<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class City
 *
 * @ORM\Entity
 * @ORM\Table(name="city")
 */
class City
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="city_id", type="integer")
	 */
	private $city_id;

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
	 * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities", cascade={"persist"})
	 * @ORM\JoinColumn(name="country_id", referencedColumnName="country_id", unique=false, nullable=false)
	 */
	protected $country;

	/**
	 * @ORM\OneToMany(targetEntity="Resort", mappedBy="city", cascade={"persist"})
	 */
	protected $resorts;

	/**
	 *
	 * @ORM\Column(name="allias", type="text")
	 */
	private $allias;


	public function setAllias($allias)
	{
		$this->allias = $allias;
	}

	public function getAllias()
	{
		return $this->allias;
	}

	public function __construct()
	{
		$this->resorts = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function setCityId($city_id)
	{
		$this->city_id = $city_id;
	}

	public function getCityId()
	{
		return $this->city_id;
	}

	public function setCountry($country)
	{
		$this->country = $country;
	}

	public function getCountry()
	{
		return $this->country;
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

	public function setResorts($resorts)
	{
		$this->resorts = $resorts;
	}

	public function getResorts()
	{
		return $this->resorts;
	}

}