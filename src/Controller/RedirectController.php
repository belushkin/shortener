<?php

namespace App\Controller;

use App\Entity\Url;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RedirectController extends AbstractController
{
    /**
     * @Route("/r/{code}", name="redirect")
     * @ParamConverter("url", class="Url", converter="code_converter")
     */
    public function index(Url $url)
    {
        return $this->redirect($url->getLink());
    }
}
