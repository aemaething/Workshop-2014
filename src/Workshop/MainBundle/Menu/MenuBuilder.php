<?php

namespace Workshop\MainBundle\Menu;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Workshop\MainBundle\Menu\Event\BuildMenuEvent;

class MenuBuilder {

	private $factory;

	private $eventDispatcher;


	public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher) {
		$this->factory = $factory;
		$this->eventDispatcher = $eventDispatcher;
	}


	public function createMainMenu(Request $request) {

		$menu = $this->factory->createItem("root", array("childrenAttributes" => array("class" => "nav")));

		$menu->addChild("Home", array("route" => "workshop_main_default_index"));

		// dispatch "createMenu" event
		$this->eventDispatcher->dispatch(MenuEvents::BUILD_MAIN_MENU, new BuildMenuEvent($menu));

		return $menu;
	}


	public function createFooterMenu(Request $request) {

		$menu = $this->factory->createItem("root", array(
			"childrenAttributes" => array("class" => "dropdown-menu")));

		// local tools
		$localTools = $menu->addChild("Local tools", array(
				"uri" => "#",
				"childrenAttributes" => array("class" => "dropdown-menu"),
				"attributes" => array("class" => "dropdown-submenu pull-left")));
		$localTools->addChild("phpMyAdmin", array(
				"uri" => "/__info__/",
				"linkAttributes" => array("target" => "_blank")));
		$localTools->addChild("APC", array(
				"uri" => "/__apc__/",
				"linkAttributes" => array("target" => "_blank")));

		// symfony documentation
		$symfony = $menu->addChild("Symfony", array(
				"uri" => "http://www.symfony.com",
				"childrenAttributes" => array("class" => "dropdown-menu"),
				"attributes" => array("class" => "dropdown-submenu pull-left"),
				"linkAttributes" => array("target" => "_blank")));
		$symfony->addChild("The book", array(
				"uri" => "http://symfony.com/doc/current/book/index.html",
				"linkAttributes" => array("target" => "_blank")));
		$symfony->addChild("The cookbook", array(
			"uri" => "http://symfony.com/doc/current/cookbook/index.html",
			"linkAttributes" => array("target" => "_blank")));
		$symfony->addChild("Index", array(
			"uri" => "http://symfony.com/doc/current/genindex.html",
			"linkAttributes" => array("target" => "_blank")));

		// twig documentation
		$menu->addChild("Twig", array(
				"uri" => "http://twig.sensiolabs.org/documentation",
				"linkAttributes" => array("target" => "_blank")));

		// doctrine documentation
		$doctrine = $menu->addChild("Doctrine", array(
				"uri" => "http://www.doctrine-project.org/",
				"childrenAttributes" => array("class" => "dropdown-menu"),
				"attributes" => array("class" => "dropdown-submenu pull-left"),
				"linkAttributes" => array("target" => "_blank")));
		$doctrine->addChild("ORM", array(
				"uri" => "http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/index.html",
				"linkAttributes" => array("target" => "_blank")));

		// knp menu documentation
		$knpMenu = $menu->addChild("KnpMenuBundle", array(
				"uri" => "https://github.com/KnpLabs/KnpMenuBundle/blob/master/Resources/doc/index.md",
				"attributes" => array("class" => "dropdown-submenu pull-left"),
				"childrenAttributes" => array("class" => "dropdown-menu"),
				"linkAttributes" => array("target" => "_blank")));
		$knpMenu->addChild("KnpMenu", array(
				"uri" => "https://github.com/KnpLabs/KnpMenu",
				"linkAttributes" => array("target" => "_blank")));

		// symfony packages
		$packages = $menu->addChild("Symfony packages", array(
			"uri" => "#",
			"attributes" => array("class" => "dropdown-submenu pull-left"),
			"childrenAttributes" => array("class" => "dropdown-menu"),
			"linkAttributes" => array("target" => "_blank")));
		$packages->addChild("KNP Bundles", array(
			"uri" => "http://knpbundles.com/",
			"linkAttributes" => array("target" => "_blank")));
		$packages->addChild("Packagist", array(
			"uri" => "https://packagist.org/",
			"linkAttributes" => array("target" => "_blank")));
		$packages->addChild("Composer", array(
			"uri" => "http://getcomposer.org/",
			"linkAttributes" => array("target" => "_blank")));


		return $menu;
	}
}
