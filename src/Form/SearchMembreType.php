<?php

namespace App\Form;

use App\Entity\Dadj;
use App\Entity\Kourel;
use App\Entity\SearchMembre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('matricule',TextType::class,array('label'=>'Matricule ','attr'=>array('class'=>'form-control ')))
            ->add('kourel',EntityType::class,array('class'=>Kourel::class,'label'=>"Kourel ",'attr'=>array('class'=>'form-control form-group')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchMembre::class,

        ]);
    }
    public function getBlockPrefix()
    {
        return "";
    }
}
