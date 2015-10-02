<?php

namespace Mod2\Entity;

use Zend\Form\Annotation;

/**
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("comment1")
 */
class Comment1
{
	/**
	 * @Annotation\Exclude()
	 */
	public $parentId;

	/**
	 * @Annotation\Type("select")
	 * @Annotation\Options({"label":"Type","value_options":{"1":"Type1","2":"Type2","3":"Type3"}})
	 */
	public $type;

	/**
	 * @Annotation\Attributes({"type":"textarea" })
	 * @Annotation\Options({"label":"Comment:"})
	 */
	public $comment;

}