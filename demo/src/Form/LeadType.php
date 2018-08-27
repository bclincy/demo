<?php

namespace App\Form;

use App\Entity\Lead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'fname',
                TextType::class,
                [
                    'label'      => 'First Name',
                    'label_attr' => ['class' => 'col-sm-2 control-label'],
                    'attr'       => ['class' => 'form-control col-sm-10'],
                ]
            )
            ->add(
                'lname',
                TextType::class,
                [
                    'label'      => 'Last Name:',
                    'label_attr' => ['class' => 'col-sm-2 control-label'],
                    'attr'       => ['class' => 'form-control col-sm-10'],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label'      => 'Email:',
                    'label_attr' => ['class' => 'col-sm-2 control-label'],
                    'attr'       => ['class' => 'form-control col-sm-10'],
                ]
            )
            ->add(
                'zipcode',
                TextType::class,
                [
                    'label'      => 'Zip Code:',
                    'label_attr' => ['class' => 'col-sm-2 control-label'],
                    'attr'       => ['class' => 'form-control col-sm-10'],
                ]
            )
            ->add(
                'phone',
                TelType::class,
                [
                    'label'      => 'Phone',
                    'label_attr' => ['class' => 'col-sm-2 control-label'],
                    'attr'       => ['class' => 'form-control col-sm-10'],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Lead::class,
            ]
        );
    }
}
