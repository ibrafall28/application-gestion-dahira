<?php

namespace App\Form;

use App\Entity\Caisse;
use App\Entity\Dadj;
use App\Entity\Evennement;
use App\Entity\Khassida;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KhassidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'Nom ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('evennement',EntityType::class,array('class'=>Evennement::class,'label'=>"Evennement ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('dadji',EntityType::class,array('class'=>Dadj::class,'label'=>"Aire ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Khassida::class,
        ]);
    }
}
