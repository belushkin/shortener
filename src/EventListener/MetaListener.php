<?php

namespace App\EventListener;

use App\Entity\Meta;
use App\Entity\Url;
use App\Service\Shortener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\TerminateEvent;

class MetaListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param Shortener $shortener
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param TerminateEvent $event
     */
    public function onKernelTerminate(TerminateEvent $event)
    {
        /** @var Url $url */
        $url = $event->getRequest()->attributes->get('url');
        if ($url instanceof Url) {
            $meta = new Meta();
            $meta
                ->setIp($event->getRequest()->getClientIp())
                ->setAgent($event->getRequest()->headers->get('User-Agent'))
                ->setUrl($url);

            $this->entityManager->persist($meta);
            $this->entityManager->flush();
        }
    }
}
