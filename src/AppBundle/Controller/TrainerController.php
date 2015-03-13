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
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trainers = $em->getRepository('AppBundle:Trainer')->findAll();

        // MonBundle:DossierDansViews:Fichier

        // "AppBundle:" => src/AppBundle/Resources/views

        return $this->render('AppBundle:Trainer:index.html.twig', [
            'trainers' => $trainers,
        ]);
    }
    /**
     * Creates a new Trainer entity.
     *
     * @Route("/create", name="trainer_create")
     *
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Trainer();

        $form = $this->createForm(new TrainerType(), $entity, array(
            'action' => $this->generateUrl('trainer_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('trainer_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:Trainer:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
        ]);
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
     * Edits an existing Trainer entity.
     *
     * @Route("/update/{id}", name="trainer_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trainer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trainer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $editForm = $this->createForm(new TrainerType(), $entity, array(
            'action' => $this->generateUrl('trainer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('trainer_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Trainer:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
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
