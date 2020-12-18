<?php

namespace App\Form;

use App\Entity\Commission;
use App\Entity\Materiel;
use App\Entity\TypeMateriel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class,array('label'=>'Libelle ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('typeMateriel',EntityType::class,array('class'=>TypeMateriel::class,'label'=>"type de materiel ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('commission',EntityType::class,array('class'=>Commission::class,'label'=>"Commission ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
