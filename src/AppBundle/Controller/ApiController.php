<?php

namespace AppBundle\Controller;

use AppBundle\Response\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/v1")
 */
class ApiController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/article", name="api_article")
     * @Method("GET")
     * @return JsonResponse
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Article')->findAll();

        return new JsonResponse($entities);
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/article", name="api_article_create")
     * @Method("POST")
     * @return JsonResponse
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('api_article_show', array('id' => $entity->getId())));
        }

        $response = new JsonResponse([], 500);

        return $response->setFailure()->setErrorMessage('Unable to create entity');
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/article/{id}", name="api_article_show")
     * @Method("GET")
     * @return JsonResponse
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Article')->find($id);

        if (!$entity) {
            $response = new JsonResponse([], 404);
            return $response->setFailure()->setErrorMessage('Unable to find Article entity.');
        }

        return new JsonResponse($entity);
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("/article/{id}", name="api_article_update")
     * @Method("PUT")
     * @return JsonResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Article')->find($id);

        if (!$entity) {
            $response = new JsonResponse([], 404);
            return $response->setFailure()->setErrorMessage('Unable to find Article entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('api_article_show', array('id' => $id)));
        }

        return new JsonResponse($entity);
    }

    /**
     * Creates a form to edit a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/article/{id}", name="api_article_delete")
     * @Method("DELETE")
     * @return JsonResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Article')->find($id);

        if (!$entity) {
            $response = new JsonResponse([], 404);
            return $response->setFailure()->setErrorMessage('Unable to find Article entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('api_article'));
    }
}
