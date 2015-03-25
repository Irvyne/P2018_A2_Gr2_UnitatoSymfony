<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController
 *
 * @package AppBundle\Controller
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/pokemon", name="api_pokemon")
     */
    public function pokemonAction()
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        // Retrieve Entity Repository
        $repo = $em->getRepository('AppBundle:Pokemon');

        // Retrieve all Pokemon entities
        $pokemons = $repo->findCatchThemAll();

        return new JsonResponse($pokemons);
    }
}
