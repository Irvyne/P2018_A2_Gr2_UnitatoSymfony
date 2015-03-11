<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        /*$array = ['ljnergzr', 9, 765=> 'zegzegr'];

        return new JsonResponse($array);*/

        return $this->render('default/index.html.twig');

        return new Response($this->renderView('default/index.html.twig'));
    }

    /**
     * @Route(
     *      "/article-{year}/{id}/comments/{page}",
     *      name="slug",
     *      defaults={
     *          "page"="1"
     *      },
     *      requirements={
     *          "id"="\d+",
     *          "page"="\d+",
     *          "year"="\d{4}"
     *      }
     * )
     *
     * @return Response
     */
    public function catchAllAction(Request $request, $page, $year, $id)
    {
        return new Response('Catch All: '.$year.' - '.$id.' - '.$page);
    }

    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/hello/{name}", name="hello_world")
     *
     * @param $name
     *
     * @return Response
     */
    public function helloWorldAction(Request $request, $name)
    {
        //return new Response("Hello World!");

        /*var_dump(
            $request->getLocale(),
            $request->getPreferredLanguage()
        );die;*/

        return $this->render('AppBundle::hello-world.html.twig', [
            'name'   => $name,
            'date'   => new \DateTime(),
            'locale' => $request->getLocale(),
        ]);
    }
}
