<?php

namespace Workshop\LessonTwoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Workshop\LessonTwoBundle\Entity\BlogPost;
use Workshop\LessonTwoBundle\Entity\BlogPostComment;
use Workshop\LessonTwoBundle\Form\BlogPostCommentType;
use Workshop\LessonTwoBundle\Form\BlogPostType;


/**
 * Class BlogPlusController
 * @package Workshop\LessonTwoBundle\Controller
 * @Route("/blog-plus")
 */
class BlogPlusController extends Controller {

	const POSTS_PER_PAGE = 6;


	/**
	 * Just do a redirect to paged page.
	 * @Route("/", name="workshop_lessonTwo_blogPlus_index")
	 */
	public function indexAction() {
		return new RedirectResponse(
				$this->generateUrl("workshop_lessonTwo_blogPlus_paged", array("page" => 1)));
	}


	/**
	 * @param $page
	 * @return array
	 * @Route("/page-{page}", name="workshop_lessonTwo_blogPlus_paged")
	 * @Template()
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


	/**
	 * @param $page
	 * @param $slug
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return array
	 * @Route("/page-{page}/{slug}/detail", name="workshop_lessonTwo_blogPlus_detail")
	 * @Template()
	 */
	public function detailAction($page, $slug) {
		$blogPost = $this->loadBlogPostBySlug($slug);

		$comments = $this
			->get('workshop_lesson_two.repository.blog_post_comment')
			->findByBlogPost($blogPost);

		return array(
			'blogPost' => $blogPost,
			'comments' => $comments,
			'page' => $page
		);
	}


	/**
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @param $page
	 * @param $slug
	 * @return array
	 * @Template()
	 * @Route("/page-{page}/{slug}/create-comment", name="workshop_lessonTwo_blogPlus_createComment")
	 */
	public function createCommentAction(Request $request, $page, $slug) {
		$blogPost = $this->loadBlogPostBySlug($slug);

		$blogPostComment = new BlogPostComment($blogPost);
		$form = $this->createForm(new BlogPostCommentType(), $blogPostComment);

		if ($request->isMethod("POST")) {

			$form->handleRequest($request);
			if ($form->isValid()) {

				$em = $this->getDoctrine()->getManager();
				$em->persist($blogPostComment);
				$em->flush();

				// always redirect => GET after successful POST
				return new RedirectResponse($this->generateUrl(
						"workshop_lessonTwo_blogPlus_detail",
						array("page" => $page, "slug" => $slug)
				));
			}
		}

		return array(
			'blogPost' => $blogPost,
			'form' => $form->createView(),
			'page' => $page,
			'slug' => $slug
		);
	}


	/**
	 * DRY!
	 * @param $slug
	 * @return BlogPost
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	private function loadBlogPostBySlug($slug) {
		$blogPost = $this
			->get('workshop_lesson_two.repository.blog_post')
			->findOneOnlineBySlug($slug);

		if (! $blogPost instanceof BlogPost) {
			throw $this->createNotFoundException(		//erzeuge einen 404 Fehler! => HTTP Status Codes
				sprintf('BlogPost [%s] wurde nicht gefunden.', $slug));
		}

		return $blogPost;
	}

}