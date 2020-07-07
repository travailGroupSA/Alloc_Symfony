<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('telephone')
            ->add('birthday',DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('boursier', ChoiceType::class, [
                'choices'  => [
                    'Non' => null,
                    'Demi-bourse' => 'demi',
                    'Bourse-entiere' => 'entiere',
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
