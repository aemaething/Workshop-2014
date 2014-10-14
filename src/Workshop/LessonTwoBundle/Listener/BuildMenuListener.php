<?php

namespace Workshop\LessonTwoBundle\Listener;

use Workshop\MainBundle\Menu\Event\BuildMenuEvent;

class BuildMenuListener {

	public function onBuildMainMenu(BuildMenuEvent $event) {
		$menu = $event->getMenu();

		$lessonTwo = $menu->addChild("Lesson Two <b class='caret'></b>", array(
			"uri" => "#",
			"linkAttributes" => array("class" => "dropdown-toggle", "data-toggle" => "dropdown"),
			"attributes" => array("class" => "dropdown"),
			"extras" => array("safe_label" => true),
			"childrenAttributes" => array("class" => "dropdown-menu")));

		$lessonTwo->addChild("Index", array(
			"route" => "workshop_lessonTwo_default_index_1"));

		$blog = $lessonTwo->addChild("Blog", array(
			"uri" => "#",
			"linkAttributes" => array("class" => "dropdown-toggle", "data-toggle" => "dropdown"),
			"attributes" => array("class" => "dropdown-submenu pull-left"),
			"childrenAttributes" => array("class" => "dropdown-menu")));

		$blog->addChild("Blog index", array(
			"route" => "workshop_lessonTwo_blog_index"));
		$blog->addChild("Blog paged", array(
			"route" => "workshop_lessonTwo_blog_paged"));
		$blog->addChild("Blog create", array(
			"route" => "workshop_lessonTwo_blog_create"));



		$blogPlus = $lessonTwo->addChild("Blog Plus", array(
			"uri" => "#",
			"linkAttributes" => array("class" => "dropdown-toggle", "data-toggle" => "dropdown"),
			"attributes" => array("class" => "dropdown-submenu pull-left"),
			"childrenAttributes" => array("class" => "dropdown-menu")));

		$blogPlus->addChild("Blog index", array(
			"route" => "workshop_lessonTwo_blogPlus_index"));
	}
}