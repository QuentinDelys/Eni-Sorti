<?php

namespace App\Form;

use App\Entity\Sortie;
use App\Form\Model\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                'required' => false,
                'attr' => [
                    'placeholder' => 'search'
                ]
            ])
            ->add('dateHeureDebut', DateTimeType::class,[
                'label' => 'Entre ',
                'required' => false
            ])
            ->add('dateHeureFin', DateTimeType::class,[
                'label'=> 'et',
                'required' => false
            ])
            ->add('sortiesOrga', CheckboxType::class,[
                'label'=> 'Sorties dont je suis l\'organisateur/trice',
                'required' => false
            ])
            ->add('sortiesInscris', CheckboxType::class,[
                'label'=> 'Sorties auxquelles je suis inscris',
                'required' => false
            ])
            ->add('sortiesPasInscris', CheckboxType::class,[
                'label'=> 'Sorties auxquelles je ne suis pas inscris',
                'required' => false
            ])
            ->add('sortiesPassees', CheckboxType::class,[
                'label'=> 'Sorties passées',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }
}
