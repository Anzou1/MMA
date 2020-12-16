<?php

namespace App\Form;

use App\Entity\Fighters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminFighterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rang', CollectionType::class, [
                'label_format'  => 'Rang du combattant:',
                'entry_type'    => ChoiceType::class,
                'entry_options'  => [
                    'choices'    => [
                        '0'  => '0',
                        '1'  => '1',
                        '2'  => '2',
                        '3'  => '3',
                        '4'  => '4',
                        '5'  => '5',
                        '6'  => '6',
                        '7'  => '7',
                        '8'  => '8',
                        '9'  => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15'

                    ]
                ]
            ])
            ->add('name')
            ->add('pays')
            ->add('age')
            ->add('poids')
            ->add('taille')
            ->add('allonge')
            ->add('palmares')
            ->add('sexe', CollectionType::class, [
                'label_format'  => 'Sexe:',
                'entry_type'    => ChoiceType::class,
                'entry_options'  => [
                    'choices'    => [
                        'Homme' => 'Homme',
                        'Femme' => 'Femme'


                    ]
                ]
            ])
            ->add('photo', FileType::class, [
                'label' => 'photo',
                'attr' => ['placeholder' => 'Telecharger combattant'],
                'mapped' => false,
                'required' => false,
            ])
            ->add('categorie', CollectionType::class, [
                'label_format'  => 'Choix de la catégorie:',
                'entry_type'    => ChoiceType::class,
                'entry_options'  => [
                    'choices'    => [
                        'Flyweight'    => 'Flyweight',
                        'Bantamweight' => 'Bantamweight',
                        'Featherweight'    => 'Featherweight',
                        'Lightweight' => 'Lightweight',
                        'Welterweight'    => 'Welterweight',
                        'Middleweight' => 'Middleweight',
                        'Light Heavyweight'    => 'Light Heavyweight',
                        'Heavyweight' => 'Heavyweight',
                        'FlyweightWoman'    => 'FlyweightWoman',
                        'BantamweightWoman' => 'BantamweightWoman',
                        'FeatherweightWoman'    => 'FeatherweightWoman'

                    ]
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fighters::class,
        ]);
    }
}
