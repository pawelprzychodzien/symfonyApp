<?php
namespace ShoeShopBundle\Form\DataTransformer;

use ShoeShopBundle\Entity\Buty;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ButyToNumberTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (Buty) to a string (number).
     *
     * @param  Buty|null $buty
     * @return string
     */
    public function transform($buty)
    {
        if (null === $buty) {
            return '';
        }

        return $buty->getId();
    }

    /**
     * Transforms a string (buty) to an object (Buty).
     *
     * @param  string $butyNumber
     * @return Buty|null
     * @throws TransformationFailedException if object (buty) is not found.
     */
    public function reverseTransform($butyNumber)
    {
        // no buty number? It's optional, so that's ok
        if (!$butyNumber) {
            return;
        }

        $buty = $this->manager
            ->getRepository('ShoeShopBundle:Buty')
            // query for the buty with this id
            ->find($butyNumber)
        ;

        if (null === $buty) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An buty with number "%s" does not exist!',
                $butyNumber
            ));
        }

        return $buty;
    }
}