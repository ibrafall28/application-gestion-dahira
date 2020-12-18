<?php

namespace App\Form;

use App\Entity\Dadj;
use App\Entity\Filtre;
use App\Entity\Kourel;
use App\Entity\SearchMembre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreHadiyaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('date',DateType::class,array('label'=>'Date ','attr'=>array('class'=>'form-control ')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filtre::class,

        ]);
    }
    public function getBlockPrefix()
    {
        return "";
    }
}
