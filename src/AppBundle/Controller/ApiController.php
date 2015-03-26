<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TrainerRepository;
use AppBundle\Entity\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\PokemonRepository;

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
     * @Route("/pokemon/{id}", name="api_pokemon", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function pokemonAction($id)
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        // Retrieve Entity Repository
        /** @var PokemonRepository $repo */
        $repo = $em->getRepository('AppBundle:Pokemon');

        // Retrieve all Pokemon entities
        $pokemons = $repo->findCatchThemAll($id);

        return new JsonResponse($pokemons);
    }

    /**
     * @Route("/type/{id}", name="api_type", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function typeAction($id)
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        // Retrieve Entity Repository
        /** @var TypeRepository $repo */
        $repo = $em->getRepository('AppBundle:Type');

        // Retrieve all Pokemon entities
        $types = $repo->findCatchThemAll($id);

        return new JsonResponse($types);
    }

    /**
     * @Route("/trainer/{id}", name="api_trainer", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function TrainerAction($id)
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        // Retrieve Entity Repository
        /** @var TrainerRepository $repo */
        $repo = $em->getRepository('AppBundle:Trainer');

        // Retrieve all Pokemon entities
        $trainers = $repo->findCatchThemAll($id);

        return new JsonResponse($trainers);
    }
}
