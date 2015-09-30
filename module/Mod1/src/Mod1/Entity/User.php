<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Class Notice
* @ORM\Entity
* @ORM\Table(name="user")
*/
class User
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
	 * @ORM\OneToOne(targetEntity="Comment", mappedBy="user", cascade={"persist"})
	 */
	protected $comment;

	public function setComment($comment)
	{
		$this->comment = $comment;
	}

	public function getComment()
	{
		return $this->comment;
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