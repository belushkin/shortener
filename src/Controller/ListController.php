<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    /**
    * @Route("/l")
    */
    public function list()
    {
        $number = random_int(0, 100);

        return $this->render('list/l.html.twig', [
            'number' => $number,
        ]);
    }
}
