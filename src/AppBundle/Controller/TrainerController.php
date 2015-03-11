<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Trainer;
use AppBundle\Form\TrainerType;

/**
 * Trainer controller.
 *
 * @Route("/trainer")
 */
class TrainerController extends Controller
{
    /**
     * Lists all Trainer entities.
     *
     * @Route("/", name="trainer")
     *
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Trainer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Trainer entity.
     *
     * @Route("/", name="trainer_create")
     *
     * @Method("POST")
     * @Template("AppBundle:Trainer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Trainer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('trainer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Trainer entity.
     *
     * @param Trainer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Trainer $entity)
    {
        $form = $this->createForm(new TrainerType(), $entity, array(
            'action' => $this->generateUrl('trainer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Trainer entity.
     *
     * @Route("/new", name="trainer_new")
     *
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Trainer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Trainer entity.
     *
     * @Route("/{id}", name="trainer_show")
     *
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trainer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trainer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Trainer entity.
     *
     * @Route("/{id}/edit", name="trainer_edit")
     *
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trainer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trainer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Trainer entity.
     *
     * @param Trainer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Trainer $entity)
    {
        $form = $this->createForm(new TrainerType(), $entity, array(
            'action' => $this->generateUrl('trainer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Trainer entity.
     *
     * @Route("/{id}", name="trainer_update")
     *
     * @Method("PUT")
     * @Template("AppBundle:Trainer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trainer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trainer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('trainer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Trainer entity.
     *
     * @Route("/{id}", name="trainer_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Trainer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Trainer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('trainer'));
    }

    /**
     * Creates a form to delete a Trainer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trainer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
