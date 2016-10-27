<?php
namespace ShoeShopBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use ShoeShopBundle\Entity\Buty;
use ShoeShopBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class ImgUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        if (!$entity instanceof Buty) {
            return;
        }

        $file = $entity->getZdjecie();

        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setZdjecie($fileName);

        $file2 = $entity->getZdjecieMIN();

        if (!$file2 instanceof UploadedFile) {
            return;
        }

        $fileName2 = $this->uploader->upload($file2);
        $entity->setZdjecieMIN($fileName2);
    }
    /*public function postLoad(Buty $buty, LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $fileName = $entity->getZdjecie();
        $fileName2 = $entity->getZdjecieMIN();

        $entity->setZdjecie(new File($this->getParameter('img_directory').'/'.$fileName));
        $entity->setZdjecieMIN(new File($this->getParameter('img_directory').'/'.$fileName2));
    }*/
}