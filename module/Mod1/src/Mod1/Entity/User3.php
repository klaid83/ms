<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Class Notice
* @ORM\Entity
* @ORM\Table(name="user_3")
*/
class User3
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
	 * @ORM\ManyToMany(targetEntity="Category3", inversedBy="users", cascade={"persist"})
	 * @ORM\JoinColumn(name="category_id", referencedColumnName="id", unique=false, nullable=true)
	 */
	protected $categories;

	public function __construct()
	{
		$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	public function getCategories()
	{
		return $this->categories;
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