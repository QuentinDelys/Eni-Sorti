<?php

namespace App\Form;

use App\Entity\Participant;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Pseudo : ",
                'attr' => [
                    'placeholder' => 'Peusdo....',]
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prénom : ",
                'attr' => [
                    'placeholder' => 'Prénom....',]
            ])
            ->add('nom', TextType::class, [
                'label' => "Nom : ",
                'attr' => [
                    'placeholder' => 'Nom....',]
            ])
            ->add('telephone', TextType::class, [
                'label' => "Téléphone :",
                'attr' => [
                    'placeholder' => '0685649568',]
            ])
            ->add('email', EmailType::class, [
                'label' => "Email : ",
                'required' => false,
                'attr' => [
                    'placeholder' => 'email@Eni.fr',]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => false,
                'invalid_message' => false,

                'first_options'  => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmation :'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe ne respect pas le minimum de caractères (6)',
                        'max' => 100,
                        'maxMessage' => 'Votre mot de passe ne respect pas le maximun de caractères (100)'
                    ])
                ]
            ])

            ->add('campus', EntityType::class, [
                'label' => 'Campus :',
                'choice_label' => "nom",
                'class' => 'App\Entity\Campus'
            ])
            ->add('photo', FileType::class, [
                'label' => "Ma photo :",
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
