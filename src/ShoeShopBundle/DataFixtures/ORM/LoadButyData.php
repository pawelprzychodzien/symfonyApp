<?php

namespace ShoeShopBundle\DataFixtures\ORM;

use ShoeShopBundle\Entity\Buty;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadButyData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=25; $i++) {
            $buty = new Buty();
            $buty->setMarka("Marka - {$i}");
            $buty->setModel("Model - {$i}!");

            $buty->setKolor("Kolor - {$i}");

            $buty->setRozmiar(array(
                $this->getReference('r' . rand(35,50)),
                $this->getReference('r'. rand(35,50))
            ));

            $buty->setCena(rand(100,1000));

            $this->addReference("b{$i}", $buty);

            $manager->persist($buty);
        }

        $manager->flush();


    }

    public function getOrder()
    {

        return 3;
    }
}
