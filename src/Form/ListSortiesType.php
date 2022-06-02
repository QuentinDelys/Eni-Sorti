<?php

namespace App\Form;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ListSortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                'label' => 'Campus :',
                'required' => false,
                'choice_label' => "nom",
                'class' => 'App\Entity\Campus'
            ])
            ->add('nom', TextType::class,[
                'label' => 'Le nom de la sortie contient :',
                'required' => false
            ])
            ->add('dateHeureDebut', DateTimeType::class,[
                'label' => 'Entre ',
                'required' => false
            ])
            ->add('dateHeureFin', DateTimeType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesOrga', DateTimeType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesInscris', DateTimeType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesPasInscris', DateTimeType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesPassees', DateTimeType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
