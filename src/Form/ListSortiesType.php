<?php

namespace App\Form;

use App\Entity\Sortie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class ListSortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', ChoiceType::class,[
                'label' => 'Campus de la sortie',
                'required' => true
            ])
            ->add('nom', TextType::class,[
                'label' => 'Le nom de la sortie contient :',
                'required' => true
            ])
            ->add('dateHeureDebut', TextType::class,[
                'label' => 'Entre ',
                'required' => true
            ])
            ->add('dateHeureFin', TextType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => true
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
