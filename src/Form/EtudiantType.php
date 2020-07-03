<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Chambre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('prenom')
            ->add('nom')
            ->add('mail')
            ->add('birthday')
            ->add('boursier', ChoiceType::class, [
                'choices'  => [
                    'Non' => null,
                    'Demi-bourse' => 'demi',
                    'Bourse-entiere' => 'entiere',
                ],
            ])
            ->add('montantBourse', ChoiceType::class, [
                'choices'  => [
                    '' => null,
                    '40000' => 40000,
                    '20000' => 20000,
                ],
            ])
            ->add('estLoge', ChoiceType::class, [
                'choices'  => [
                    '' => null,
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('chambre',EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => function($chambre){
                    return $chambre->getNumChambre();
                },
            ]) 
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
