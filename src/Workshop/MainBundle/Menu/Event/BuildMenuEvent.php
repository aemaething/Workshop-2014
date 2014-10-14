<?php

namespace Workshop\MainBundle\Menu\Event;


use Symfony\Component\EventDispatcher\Event;
use Knp\Menu\ItemInterface;


/**
 * Class CreateMenuEvent
 * @package Workshop\MainBundle\Menu\Event
 */
class BuildMenuEvent extends Event {

	/**
	 * @var ItemInterface
	 */
	private $menu;




	/**
	 * @param \Knp\Menu\ItemInterface $menu
	 * @return \Workshop\MainBundle\Menu\Event\BuildMenuEvent
	 */
	public function __construct(ItemInterface $menu) {
		$this->menu = $menu;
	}


	/**
	 * @return \Knp\Menu\ItemInterface
	 */
	public function getMenu()
	{
		return $this->menu;
	}
}