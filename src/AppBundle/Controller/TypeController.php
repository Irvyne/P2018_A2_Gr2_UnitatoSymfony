<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Type;
use AppBundle\Form\TypeType;

/**
 * Type controller.
 *
 * @Route("/type")
 */
class TypeController extends Controller
{
    /**
     * Lists all Type entities.
     *
     * @Route("/", name="type")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('AppBundle:Type')->findAll();

        return $this->render('AppBundle:Type:index.html.twig', [
            'types' => $types,
        ]);
    }

    /**
     * Creates a new Type entity.
     *
     * @Route("/create", name="type_create")
     * @Method("GET|POST")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $type = new Type();

        $form = $this->createForm(new TypeType(), $type, [
            'action' => $this->generateUrl('type_create'),
            'method' => 'POST',
        ]);

        $form->add('submit', 'submit', ['label' => 'Create']);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();

            return $this->redirect($this->generateUrl('type_show', ['id' => $type->getId()]));
        }

        return $this->render('AppBundle:Type:new.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a Type entity.
     *
     * @Route("/{id}", name="type_show")
     *
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('AppBundle:Type')->find($id);

        if (!$type) {
            throw $this->createNotFoundException('Unable to find Type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Type:show.html.twig', [
            'type'        => $type,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Type entity.
     *
     * @Route("/update/{id}", name="type_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository('AppBundle:Type')->find($id);

        if (!$type) {
            throw $this->createNotFoundException('Unable to find Type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $editForm = $this->createForm(new TypeType(), $type, [
            'action' => $this->generateUrl('type_update', ['id' => $type->getId()]),
            'method' => 'PUT',
        ]);

        $editForm->add('submit', 'submit', ['label' => 'Update']);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('type_show', ['id' => $id]));
        }

        return $this->render('AppBundle:Type:edit.html.twig', [
            'type'        => $type,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }
    /**
     * Deletes a Type entity.
     *
     * @Route("/{id}", name="type_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Type')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Type entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('type'));
    }

    /**
     * Creates a form to delete a Type entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_delete', ['id' => $id]))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Delete'])
            ->getForm()
        ;
    }
}
