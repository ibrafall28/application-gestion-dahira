<?php

namespace App\Form;

use App\Entity\Commission;
use App\Entity\Depense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextType::class,array('label'=>'Description ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('montant',TextType::class,array('label'=>'Montant ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('date',DateType::class,array('label'=>'Date ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('commission',EntityType::class,array('class'=>Commission::class,'label'=>"Commission ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Depense::class,
        ]);
    }
}
