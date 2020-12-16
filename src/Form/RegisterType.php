<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TypeTextType::class, ['constraints' => new Length(['min' => 2, 'max' => 30]), 'attr' => ['placeholder' => 'Entrez votre Pseudo']])

            ->add('nom', TypeTextType::class, ['constraints' => new Length(['min' => 2, 'max' => 30]), 'attr' => ['placeholder' => 'Entrez votre Nom']])

            ->add('prenom', TypeTextType::class, ['constraints' => new Length(['min' => 2, 'max' => 30]), 'attr' => ['placeholder' => 'Entrez votre Prenom']])

            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'Entrez votre Email']])

            ->add('password', RepeatedType::class, [
                'type' => passwordType::class,
                'invalid_message' => 'Le mot de passe ne correspond pas',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Veuillez saisir votre mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => ['placeholder' => 'Veuillez confirmer votre mot de passe']
                ]
            ])

            ->add('Photo', FileType::class, [
                'label' => 'Photo',
                'attr' => ['placeholder' => 'Téléchargez votre avatar'],
                'mapped' => false,
                'required' => false,
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Inscription'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
