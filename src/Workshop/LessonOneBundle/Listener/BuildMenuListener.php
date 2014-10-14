<?php

namespace Workshop\LessonOneBundle\Listener;
use Workshop\MainBundle\Menu\Event\BuildMenuEvent;

class BuildMenuListener {

	public function onBuildMainMenu(BuildMenuEvent $event) {
		$menu = $event->getMenu();

		$lessonOne = $menu->addChild("Lesson One <b class='caret'></b>", array(
					"uri" => "#",
					"linkAttributes" => array("class" => "dropdown-toggle", "data-toggle" => "dropdown"),
					"attributes" => array("class" => "dropdown"),
					"extras" => array("safe_label" => true),
					"childrenAttributes" => array("class" => "dropdown-menu")));

		$lessonOne->addChild("Templating", array(
				"route" => "workshop_lessonOne_default_index"));
		$lessonOne->addChild("Security", array(
				"route" => "workshop_lessonOne_secured_index"));
	}
}