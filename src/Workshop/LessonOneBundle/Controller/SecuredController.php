<?php

namespace Workshop\LessonOneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Class SecuredController
 * @package Workshop\LessonOneBundle\Controller
 *
 * @Route("/secured")
 */
class SecuredController extends Controller {

	/**
	 * @param Request $request
	 * @return array
	 *
	 * @Route("/", name="workshop_lessonOne_secured_index")
	 * @Template()
	 */
	public function indexAction(Request $request) {
		return array();
	}

}