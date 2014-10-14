<?php

namespace Workshop\LessonTwoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Workshop\LessonTwoBundle\Entity\BlogPost;
use Workshop\LessonTwoBundle\Form\BlogPostType;


/**
 * Class BlogController
 * @package Workshop\LessonTwoBundle\Controller
 * @Route("/blog")
 */
class BlogController extends Controller {

	const POSTS_PER_PAGE = 6;

	/**
	 * @Route("/", name="workshop_lessonTwo_blog_index")
	 * @Template()
	 * @return array
	 */
	public function indexAction() {
		return array(
			'blogPosts' => $this
				->get('workshop_lesson_two.repository.blog_post')
				->findAll()
		);
	}


	/**
	 * @Route("/paged/{page}", name="workshop_lessonTwo_blog_paged", defaults={"page"=1})
	 * @Template()
	 * @param $page
	 * @return array
	 */
	public function pagedAction($page) {

		$paginator  = $this->get('knp_paginator');
		$query = $this
			->get('workshop_lesson_two.repository.blog_post')
			->createPaginationQuery();

		return array(
			'page' => $page,
			'pagination' => $paginator
				->paginate($query, $page, self::POSTS_PER_PAGE)
		);
	}


	// Die folgende Methode könnte auch den "slug" verwenden.
	// Welche Änderungen stünden dafür an?
	/**
	 * @Route("/detail/{page}-{id}", name="workshop_lessonTwo_blog_detail_id")
	 * @Template()
	 * @param $page
	 * @param $id
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return array
	 */
	public function detailAction($page, $id) {
		$blogPost = $this
			->get('workshop_lesson_two.repository.blog_post')
			->findOneOnlineById($id);

		if (! $blogPost instanceof BlogPost) {
			throw $this->createNotFoundException(		//erzeuge einen 404 Fehler! => HTTP Status Codes
					sprintf('BlogPost [%s] wurde nicht gefunden.', $id));
		}

		return array(
			'blogPost' => $blogPost,
			'page' => $page
		);
	}


	/**
	 * @Route("/create", name="workshop_lessonTwo_blog_create")
	 * @Template()
	 * @param Request $request
	 * @return array
	 */
	public function createAction(Request $request) {
		// Request wird automatisch eingefügt
		// Alternativ: $request = $this->get('request') oder
		//             $request = $this->getRequest()

		$blogPost = new BlogPost();
		$form = $this->createForm(new BlogPostType(), $blogPost);

		if ($request->isMethod('POST')) {		// ist es ein POST request?

			$form->handleRequest($request); 	// Request an Formular reichen
			if ($form->isValid()) {				// ist das Formular gültig?
				$entityManager = $this			// entity manager holen
					->getDoctrine()
					->getManager();

				$entityManager->persist($blogPost);		// Objekt zum Speichern registrieren
				$entityManager->flush();				// Speichern

				// Tipp: Immer einen Redirect auf einen GET nach einem erfolgreichen POST.
				// Weil: Wenn der User Reload drückt, werden die Daten nicht zweimal
				//       gespeichert.
				return $this->redirect($this->generateUrl(		// Umleiten zur Ansicht
					'workshop_lessonTwo_blog_detail_id',
					array('id' => $blogPost->getId(), 'page' => 1)));
			}
		}

		return array(
			'form' => $form->createView()
		);
	}
}