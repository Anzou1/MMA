<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TypeTextType::class,['constraints'=> new Length(['min'=>2,'max'=> 30]),'attr' =>['placeholder'=>'Entré votre Nom']])

            ->add('prenom',TypeTextType::class,['constraints'=> new Length(['min'=>2,'max'=> 30]),'attr' =>['placeholder'=>'Entré votre Prenom']])

            ->add('email',EmailType::class,['attr' =>['placeholder'=>'Entré votre Email']])

            ->add('password',RepeatedType::class,[
                'type'=>passwordType::class,
                'invalid_message' => 'Le mots de passe ne correspond pas',
                'required' => true,
                'first_options' =>['label'=>'Mot de passe',
                                    'attr' =>['placeholder'=>'Veuillez saisir votre mot de passe']],
                'second_options'=>['label'=>'Confirmez votre mot de passe',
                                   'attr' =>['placeholder'=>'Veuillez confirmé votre mot de passe']]])

           
        
            ->add('submit',SubmitType::class,[
                'label'=>'inscription'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
