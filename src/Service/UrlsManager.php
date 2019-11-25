<?php

namespace App\Service;

use App\Entity\Url;
use App\Entity\User;
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

    public function list(User $user = null)
    {
        return $this->entityManager
            ->getRepository(Url::class)
            ->findUrlsWithCount($user);
    }

    public function save(Url $url, User $user = null)
    {
        $this->entityManager->persist($url);
        $this->entityManager->flush();

        $url->setUser($user);
        $url->setCode(
            $this->shortener->short(
                $url->getId()
            )
        );
        $this->entityManager->persist($url);
        $this->entityManager->flush();
    }

}
