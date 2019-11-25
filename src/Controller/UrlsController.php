<?php

namespace App\Controller;

use App\Entity\Url;
use App\Entity\User;
use App\Form\UrlType;
use App\Service\UrlsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UrlsController extends AbstractController
{

    /**
     * @var UrlsManager
     */
    private $manager;

    /**
     * @param UrlsManager $manager
     */
    public function __construct(UrlsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="urls")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $url = new Url();

        /** @var $user User */
        $user = $this->getUser();

        $form = $this->createForm(UrlType::class, $url);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->save($url, $user);
            return $this->redirectToRoute("urls");
        }
        return $this->render('urls/index.html.twig', [
            'urlsForm'  => $form->createView(),
            'urls'      => $this->manager->list($user)
        ]);
    }
}
