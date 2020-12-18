<?php

namespace App\Form;

use App\Entity\Kourel;
use App\Entity\Lieu;
use App\Entity\Repetition;
use App\Entity\TypeRepetition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Time;

class RepetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heurdebut',TimeType::class,array('label'=>'Heur de debut ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('heurfin',TimeType::class,array('label'=>'Heur de fin ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('date',DateType::class,array('label'=>'date  ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('kourel',EntityType::class,array('class'=>Kourel::class,'label'=>"Kourel ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('typere',EntityType::class,array('class'=>TypeRepetition::class,'label'=>"type de repetition ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('lieu',EntityType::class,array('class'=>Lieu::class,'label'=>"lieu de repetition ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Repetition::class,
        ]);
    }
}
