<?php

namespace App\Form;

use App\Entity\Sortie;
use app\Form\Model\Search;
use phpDocumentor\Reflection\Types\Boolean;
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
                'required' => false
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
            ->add('$sortiesOrga', Boolean::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesInscris', Boolean::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesPasInscris', Boolean::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
            ->add('$sortiesPassees', Boolean::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
//            'data_class' => Search::class,
            'data_class' => null,
        ]);
    }
}
