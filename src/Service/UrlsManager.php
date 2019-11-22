<?php

namespace App\Service;

use App\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;

class UrlsManager
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ShortInterface
     */
    private $shortener;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Shortener $shortener
     */
    public function __construct(EntityManagerInterface $entityManager, Shortener $shortener)
    {
        $this->entityManager = $entityManager;
        $this->shortener = $shortener;
    }

    public function list()
    {
        return $this->entityManager->getRepository(Url::class)->findAll();
    }

    public function save(Url $url)
    {
        $this->entityManager->persist($url);
        $this->entityManager->flush();

        $url->setCode(
            $this->shortener->short(
                $url->getId()
            )
        );
        $this->entityManager->persist($url);
        $this->entityManager->flush();
    }

}
