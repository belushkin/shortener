<?php

namespace App\Converter;

use App\Entity\Url;
use App\Service\Shortener;
use App\Service\ShortInterface;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CodeConverter implements ParamConverterInterface
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

    /**
     * {@inheritdoc}
     *
     * Applies converting
     *
     * @throws InvalidArgumentException  When route attributes are missing
     * @throws NotFoundHttpException     When object not found
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $code = $request->attributes->get('code');
        if (null === $code) {
            throw new InvalidArgumentException('Route attribute is missing');
        }

        $id  = $this->shortener->unshort($code);
        $url = $this->entityManager->getRepository(Url::class)->find($id);

        if (null === $url) {
            throw new NotFoundHttpException(sprintf('%s object not found.', $configuration->getClass()));
        }

        // Map found village to the route's parameter
        $request->attributes->set($configuration->getName(), $url);
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return $configuration->getName() === "url";
    }
}
