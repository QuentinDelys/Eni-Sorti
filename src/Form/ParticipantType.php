<?php

namespace App\Form;

use App\Entity\Participant;
use Doctrine\DBAL\Types\TextType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,[
                'label' => "Pseudo : ",
                'attr' => [
                    'placeholder' => 'Peusdo....',]
                    ])
            ->add('prenom',TextType::class,[
                'label' => "Prénom : ",
                'attr' => [
                    'placeholder' => 'Prénom....',]
            ])
            ->add('nom',TextType::class,[
                'label' => "Nom : ",
                'attr' => [
                    'placeholder' => 'Nom....',]
            ])
            ->add('telephone', Integer::class,[
                'label' => "Téléphone :",
                'attr' => [
                    'placeholder' => '0685649568',]
            ])
            ->add('email', Email::class,[
                'label' => "Email : ",
                'attr' => [
                    'placeholder' => 'email@Eni.fr',]
            ])
            ->add('password')
            ->add('ConfPassword')
            ->add('campus',EntityType::class,[
                'label' => 'Campus :',
                'choice_label' => "nom",
                'class' => 'App\Entity\Campus'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
