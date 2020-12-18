<?php

namespace App\Form;

use App\Entity\Caisse;
use App\Entity\Commission;
use App\Entity\Hadiya;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HadiyaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant',TextType::class,array('label'=>'Montant ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('date',DateType::class,array('label'=>'Date ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('caisse',EntityType::class,array('class'=>Caisse::class,'label'=>"Caisse ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hadiya::class,
        ]);
    }
}
