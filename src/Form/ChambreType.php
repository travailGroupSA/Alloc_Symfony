<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'numChambre',
                null,
                [
                    'disabled' => true,
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Le numero du chambre sera genere'],
                ]
            )
            ->add(
                'numBatiment',
                null,
                [
                    'label'  => false,
                    'attr' => ['class' => 'form-control', 'placeholder' => 'Le numero du Batiment'],
                ]
            )
            ->add(
                'type',
                ChoiceType::class,
                [
                    'label'  => false,
                    'choices' => [
                        'Type...' => false,
                        'individuel' => 'individuel',
                        'A deux' => 'a deux',
                    ],
                    'attr' => ['class' => 'form-control'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}