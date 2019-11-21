<?php

namespace App\Controller;

use App\Entity\Url;
use App\Form\UrlType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UrlsController extends AbstractController
{
    /**
     * @Route("/", name="urls")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        $url = new Url();

        $form = $this->createForm(UrlType::class, $url);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $url->setCreated(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($url);
            $entityManager->flush();
        }
        return $this->render('urls/index.html.twig', [
            'urlsForm' => $form->createView()
        ]);
    }
}
