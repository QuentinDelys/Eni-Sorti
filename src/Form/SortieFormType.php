<?php

namespace App\Form;

use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie :',
                'required' => true
            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                'label' => 'Date et heure de début',
                'required' => true
            ])
            ->add('dateLimiteInscription', DateTimeType::class, [
                'label' => 'Date limite d\'inscription',
                'required' => true
            ])
            ->add('nbInscriptionMax', TextType::class, [
                'label' => 'Nombre max d\'inscrits',
                'required' => true
            ])
            ->add('duree', IntegerType::class, [
                "label" => 'Durée de la sortie',
                'required' => true,

            ])
            ->add('infosSortie', TextareaType::class, [
                'label' => "Informations de la sortie",
                'attr' => [
                    'class' => "descText"
                ]
            ])
//            ->add('participants', TextType::class, [
//                'label' => 'Participants de la sortie',
//                'required' => true,
//                'mapped' => false
//            ])
            ->add('Campus', EntityType::class, [
                'label' => 'Campus de la sortie',
                'choice_label' => "nom",
                'class' => 'App\Entity\Campus',
                'required' => true
            ])
            ->add('ville', EntityType::class, [
                'label' => 'ville de la sortie',
                'choice_label' => "nom",
                'class' => 'App\Entity\Ville',
                'required' => true, 'mapped' => false
            ])
            ->add('Lieu', EntityType::class, [
                'label' => 'Campus de la sortie',
                'choice_label' => "nom",
                'class' => 'App\Entity\Lieu',
                'required' => true
            ]);

//            ->add('date', TextType::class, [
//                'label' => 'Etat de la sortie',
//                'required' => true
//            ])
//            ->add('rue', TextType::class, [
//                'label' => 'rue',
//                'required' => true, 'mapped' => false
//            ])
//            ->add('codePostal', TextType::class, [
//                'label' => 'codePostal',
//                'required' => true, 'mapped' => false
//            ])
//            ->add('latitude', TextType::class, [
//                'label' => 'latitude',
//                'required' => true, 'mapped' => false
//            ])
//            ->add('longitude', TextType::class, [
//                'label' => 'longitude',
//                'required' => true, 'mapped' => false
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class
        ]);
    }
}
