<?php

namespace App\Form;


use App\Entity\Fighters;
use App\NewClass\Recherche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string',TextType::class,['label'=>'Recherche','required'=>false,'attr'=>['placeholder'=>'Que voulez-vous chercher ?']])
            ->add('submit',SubmitType::class,[
                'label'=>'Recherche'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recherche::class,
            'method'=>'GET'

        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }


}