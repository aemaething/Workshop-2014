<?php

namespace Workshop\LessonOneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="workshop_lessonOne_default_index")
     * @Template()
	 * @see http://twig.sensiolabs.org/documentation
     */
    public function indexAction()
    {
        return array(
			"iterable" => $this->createIterableData(),
			"datetime" => new \DateTime("now")
		);
    }


	/**
	 * @return array
	 *
	 * @see https://github.com/fzaninotto/Faker
	 */
	private function createIterableData() {
		$faker = $this->get('faker.generator');

		$data = array();
		for ($i = 1; $i <= 10; $i++) {
			$data[$i] = sprintf("%s, %s", $faker->name, $faker->address);
		}

		return $data;
	}
}
