<?php

namespace Mod1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Notice
 * @ORM\Entity
 * @ORM\Table(name="comment_2")
 */
class Comment2
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
	 * @ORM\OneToMany(targetEntity="Comment2", mappedBy="parent", cascade={"persist"})
	 */
	protected $children;

	/**
	 * @ORM\ManyToOne(targetEntity="Comment2", inversedBy="children", cascade={"persist"})
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", unique=false, nullable=true)
	 */
	protected $parent;

	public function __construct()
	{
		$this->children = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function setChildren($children)
	{
		$this->children = $children;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function setParent($parent)
	{
		$this->parent = $parent;
	}

	public function getParent()
	{
		return $this->parent;
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