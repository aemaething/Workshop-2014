<?php

namespace Workshop\LessonTwoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello", name="workshop_lessonTwo_default_index_1")
	 * @Route("/hello/{name}", name="workshop_lessonTwo_default_index_2")
     * @Template()
     */
    public function indexAction($name = null)
    {
        return array('name' => $name);
    }
}
