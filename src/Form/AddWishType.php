<?php

namespace App\Form;

use App\Entity\Wish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddWishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, ['required'=>false,'label'=>'Titre', 'attr'=>['placeholder'=>'Titre du wish']])
            ->add('description',null, ['required'=>false])
            ->add('author', null, ['required'=>false])
            //->add('isPublished')
            ->add('dateCreated',DateType::class,['required'=>false,'html5'=>true, 'widget'=>'single_text'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
