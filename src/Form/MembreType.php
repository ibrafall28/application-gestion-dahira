<?php

namespace App\Form;

use App\Entity\Commission;
use App\Entity\Kourel;
use App\Entity\Membre;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'Nom ','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('prenom',TextType::class,array('label'=>'Prenom','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('adresse',TextType::class,array('label'=>'adresse','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('telephone',TextType::class,array('label'=>'telephone','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('age',TextType::class,array('label'=>'age','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('sexe',ChoiceType::class,array('choices'=>['M'=>'M','F'=> 'F'],'label'=>'Genre','attr'=>array('required'=>'require','class'=>'form-control ')))
            ->add('commission',EntityType::class,array('class'=>Commission::class,'label'=>"Commission ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))
            ->add('kourel',EntityType::class,array('class'=>Kourel::class,'label'=>"Kourel ",'attr'=>array('require'=>'require','class'=>'form-control form-group')))



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
