<?php

namespace ShoeShopBundle\Form;

use Doctrine\ORM\EntityRepository;
use ShoeShopBundle\Entity\Rozmiar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ShoeShopBundle\Entity\Buty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/*use ShoeShopBundle\Form\DataTransformer\ButyToNumberTransformer; // We include the datatransformer created previously
use Doctrine\ORM\EntityManager;*/

class ButyType extends AbstractType
{
    /*private $entityManager;

    public function __construct(EntityManager $entityManager) // Create the constructor if not exist and add the entity manager as first parameter (we will add it later)
    {
        $this->entityManager = $entityManager;
    }*/
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marka', ChoiceType::class, array(
                'choices_as_values' => true,
                'choices' => array('Adidas'=>'Adidas', 'Asics'=>'Asics', 'Nike'=>'Nike', 'Puma'=>'Puma'
                )
            ))
            ->add('model', TextareaType::class, array(
                'data_class' => 'ShoeShopBundle\Entity\Buty',
            ))
            ->add('kolor', TextareaType::class, array(
                'data_class' => 'ShoeShopBundle\Entity\Buty',
            ))
            ->add('cena', TextareaType::class, array(
                'data_class' => 'ShoeShopBundle\Entity\Buty',
            ))
            ->add('rozmiar', EntityType::class, array(
                    'class' => 'ShoeShopBundle:Rozmiar',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('r')
                            ->orderBy('r.rozmiar', 'ASC');
                    }, 'choice_label' => 'rozmiar',
                )
            )
            ->add('zdjecie', FileType::class, array(
                'data_class'=> 'Symfony\Component\Form\Extension\Core\Type\FileType',
                'property_path' => 'zdjecie',
                'label' => 'Zdjecie (img file)'))
            ->add('zdjecieMIN', FileType::class, array(
                'data_class'=> 'Symfony\Component\Form\Extension\Core\Type\FileType',
                'property_path' => 'zdjecieMIN',
                'label' => 'Zdjecie miniatura (img file)'));

        /*$builder->get('marka')
            ->addModelTransformer(new ButyToNumberTransformer($this->entityManager)); // finally we apply the transformer*/
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShoeShopBundle\Entity\Buty'
        ));
    }
}