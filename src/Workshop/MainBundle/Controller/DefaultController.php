<?php

namespace Workshop\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package Workshop\MainBundle\Controller
 *
 */
class DefaultController {

	/**
	 * @return array
	 *
	 * @Route("/", name="workshop_main_default_index")
	 * @Template()
	 */
	public function indexAction() {
		return array();
	}

}