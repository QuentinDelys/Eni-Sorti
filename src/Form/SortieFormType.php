<?php

namespace App\Form;

use App\Entity\Sortie;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => 'Nom de la sortie',
                'required' => true
            ])
            ->add('dateHeureDebut', TextType::class,[
                'label' => 'Date et heure de début',
                'required' => true
            ])
            ->add('duree', TextType::class,[
                'label' => 'Durée de la sortie',
                 'required' => true
            ])
            ->add('dateLimiteInscription', TextType::class,[
                'label'=> 'Date limite d\'inscription',
                'required' => true
            ])
            ->add('nbInscriptionMax', TextType::class,[
                'label' => 'Nombre max d\'inscrits',
                            'required' => true
            ])
            ->add('infosSortie', TextType::class,[
                'label' => 'Informations de la sortie',
                'required' => true
            ])
            ->add('organisateur', TextType::class,[
                'label' => 'Organisateur de la sortie',
                'required' => true
            ])
            ->add('participants', TextType::class,[
                'label' => 'Participants de la sortie',
                'required' => true
            ])
            ->add('campus', TextType::class,[
                'label' => 'Campus de la sortie',
                'required' => true
            ])
            ->add('lieu', TextType::class,[
                'label' => 'Lieu de la sortie',
                'required' => true
            ])
            ->add('etat', TextType::class,[
                'label' => 'Etat de la sortie',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
