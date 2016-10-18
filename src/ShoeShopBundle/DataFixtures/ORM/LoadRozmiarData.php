<?php
namespace ShoeShopBundle\DataFixtures\ORM;

use ShoeShopBundle\Entity\Rozmiar;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRozmiarData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i=35; $i<=50; $i++ ){
            $rozmiar = new Rozmiar();
            $rozmiar->setRozmiar("{$i}");
            $this->setReference("r{$i}", $rozmiar);
            $manager->persist($rozmiar);
        }


        $manager->flush();


    }

    public function getOrder()
    {

        return 2;
    }
}