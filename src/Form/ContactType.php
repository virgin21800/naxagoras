<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('raison_sociale', TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('objet',  TextType::class, array('attr'=>array('class'=>'form-control')))
            ->add('email', EmailType::class, array('attr'=>array('class'=>'form-control')))
            ->add('message', TextareaType::class, array('attr'=>array('class'=>'form-control')))
            ->add('submit', SubmitType::class, array('attr'=>array('class'=>'btn btn-danger mt-5')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
