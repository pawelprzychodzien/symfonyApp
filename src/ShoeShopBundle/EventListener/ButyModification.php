<?php
namespace ShoeShopBundle\EventListener;


use ShoeShopBundle\Entity\Buty;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ButyModification
{
    public function butyLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Buty) {
            return;
        }

        $entity->setMarka($entity->getMarka());
        $entity->setModel($entity->getModel());
        $entity->setKolor($entity->getKolor());
        $entity->setCena($entity->getCena());
        $entity->setRozmiar($entity->getRozmiar());
        $entity->setZdjecie($entity->getZdjecie());
        $entity->setZdjecieMIN($entity->getZdjecieMIN());
    }
}