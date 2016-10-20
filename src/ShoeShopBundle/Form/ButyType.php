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

class ButyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marka', ChoiceType::class, array(
                'data_class' => 'ShoeShopBundle\Entity\Buty',
                'choices' => ['Adidas', 'Asics', 'Nike', 'Puma'
                ]
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
                'data_class'=> null,
                'property_path' => 'zdjecie',
                'label' => 'Zdjecie (img file)'))
            ->add('zdjecieMIN', FileType::class, array(
                'data_class'=> null,
                'property_path' => 'zdjecieMIN',
                'label' => 'Zdjecie miniatura (img file)'));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }
}