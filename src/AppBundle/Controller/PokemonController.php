<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Pokemon;
use AppBundle\Form\PokemonType;

/**
 * Pokemon controller.
 *
 * @Route("/pokemon")
 */
class PokemonController extends Controller
{
    /**
     * Lists all Pokemon entities.
     *
     * @Route("/", name="pokemon")
     *
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Pokemon')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pokemon entity.
     *
     * @Route("/", name="pokemon_create")
     *
     * @Method("POST")
     * @Template("AppBundle:Pokemon:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pokemon();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pokemon_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pokemon entity.
     *
     * @param Pokemon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pokemon $entity)
    {
        $form = $this->createForm(new PokemonType(), $entity, array(
            'action' => $this->generateUrl('pokemon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pokemon entity.
     *
     * @Route("/new", name="pokemon_new")
     *
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pokemon();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pokemon entity.
     *
     * @Route("/{id}", name="pokemon_show")
     *
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pokemon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pokemon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pokemon entity.
     *
     * @Route("/{id}/edit", name="pokemon_edit")
     *
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pokemon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pokemon entity.');
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
     * Creates a form to edit a Pokemon entity.
     *
     * @param Pokemon $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Pokemon $entity)
    {
        $form = $this->createForm(new PokemonType(), $entity, array(
            'action' => $this->generateUrl('pokemon_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pokemon entity.
     *
     * @Route("/{id}", name="pokemon_update")
     *
     * @Method("PUT")
     * @Template("AppBundle:Pokemon:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pokemon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pokemon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pokemon_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pokemon entity.
     *
     * @Route("/{id}", name="pokemon_delete")
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Pokemon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pokemon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pokemon'));
    }

    /**
     * Creates a form to delete a Pokemon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pokemon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
