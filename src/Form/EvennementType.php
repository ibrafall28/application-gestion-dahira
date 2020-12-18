<?php

namespace App\Form;

use App\Entity\Evennement;
use App\Entity\Kourel;
use App\Entity\TypeEv;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvennementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'Nom ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('typeeve',EntityType::class,array('class'=>TypeEv::class,'label'=>"Type D'evennement ",'attr'=>array('require'=>'require','class'=>'form-control form-group'))
)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evennement::class,
        ]);
    }
}
