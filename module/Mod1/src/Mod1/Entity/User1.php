<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Class Notice
* @ORM\Entity
* @ORM\Table(name="user_1")
*/
class User1
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
	 * @ORM\OneToMany(targetEntity="Comment1", mappedBy="user", cascade={"persist"})
	 */
	protected $comments;

	public function __construct()
	{
		$this->comments = new \Doctrine\Common\Collections\ArrayCollection();
	}


	public function setComments($comments)
	{
		$this->comments = $comments;
	}

	public function getComments()
	{
		return $this->comments;
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