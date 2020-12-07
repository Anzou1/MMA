<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class ChangeInfosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Prenom', TypeTextType::class, [
                'disabled' => true
            ])
            ->add('Nom', TypeTextType::class, [
                'disabled' => true
            ])
            ->add('email', EmailType::class, [
                'disabled' => true,
            ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => ' Mot de passe actuelle', 'attr' => ['placeholder' => 'entrez votre mot de passe']
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => passwordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mots de passe ne correspond pas',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'attr' => ['placeholder' => 'Veuillez saisir votre mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => ['placeholder' => 'Veuillez confirmé votre mot de passe']
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
