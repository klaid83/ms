<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Notice
 * @ORM\Entity
 * @ORM\Table(name="category_3")
 */
class Category3
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 *
	 * @ORM\Column(name="name", type="text")
	 */
	private $name;


	/**
	 * @ORM\ManyToMany(targetEntity="User3", mappedBy="categories", cascade={"persist"})
	 */
	protected $users;

	public function __construct()
	{
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function setUsers($users)
	{
		$this->users = $users;
	}

	public function getUsers()
	{
		return $this->users;
	}


	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
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