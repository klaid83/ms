<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Notice
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(name="id", type="integer")
	 */
	private $id;

	/**
	 *
	 * @ORM\Column(name="message", type="text")
	 */
	private $message;

	/**
	 * @ORM\OneToOne(targetEntity="User", inversedBy="address", cascade={"persist"})
	 * @ORM\JoinColumn(name="userId", referencedColumnName="id", unique=false, nullable=false)
	 */
	protected $user;

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setMessage($message)
	{
		$this->message = $message;
	}

	public function getMessage()
	{
		return $this->message;
	}
}