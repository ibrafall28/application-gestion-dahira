<?php

namespace App\Form;

use App\Entity\Dadj;
use App\Entity\Kourel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DadjType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'Nom ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('kourel',EntityType::class,array('class'=>Kourel::class,'label'=>"Kourel ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dadj::class,
        ]);
    }
}
