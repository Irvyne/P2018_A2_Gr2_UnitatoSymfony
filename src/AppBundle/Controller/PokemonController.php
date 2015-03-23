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
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pokemons = $em->getRepository('AppBundle:Pokemon')->findAll();

        return $this->render('AppBundle:Pokemon:index.html.twig', [
            'pokemons' => $pokemons,
        ]);
    }
    /**
     * Creates a new Pokemon entity.
     *
     * @Route("/create", name="pokemon_create")
     *
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $pokemon = new Pokemon();

        $form = $this->createForm(new PokemonType(), $pokemon, array(
            'action' => $this->generateUrl('pokemon_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pokemon);
            $em->flush();

            return $this->redirect($this->generateUrl('pokemon_show', array('id' => $pokemon->getId())));
        }

        return $this->render('AppBundle:Pokemon:new.html.twig', [
            'pokemon' => $pokemon,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a Pokemon entity.
     *
     * @Route("/{id}", name="pokemon_show")
     *
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $pokemon = $em->getRepository('AppBundle:Pokemon')->find($id);

        if (!$pokemon) {
            throw $this->createNotFoundException('Unable to find Pokemon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Pokemon:show.html.twig', [
            'pokemon'     => $pokemon,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Pokemon entity.
     *
     * @Route("/update/{id}", name="pokemon_update")
     *
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $pokemon = $em->getRepository('AppBundle:Pokemon')->find($id);

        if (!$pokemon) {
            throw $this->createNotFoundException('Unable to find Pokemon entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $editForm = $this->createForm(new PokemonType(), $pokemon, array(
            'action' => $this->generateUrl('pokemon_update', array('id' => $pokemon->getId())),
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pokemon_show', array('id' => $id)));
        }

        return $this->render('AppBundle:Pokemon:edit.html.twig', [
            'pokemon'     => $pokemon,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
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
