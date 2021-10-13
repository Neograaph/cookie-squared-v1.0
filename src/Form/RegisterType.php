<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['autofocus'=>true, 'placeholder' => 'Prénom'],
                'label' => FALSE
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['placeholder' => 'Nom'],
                'label' => FALSE
            ])
            ->add('email', EmailType::class, [
                'label' => FALSE,
                'attr' => ['placeholder' => 'E-mail']
            ])
            ->add('password', RepeatedType::class, [
                'type' =>PasswordType::class,
                'label' => FALSE,
                'invalid_message' => "Votre mot de passe doit être identique !",
                'required' => true,
                'first_options' => ['label' => FALSE, 'attr' => ['placeholder' => 'Mot de passe']],
                'second_options' => ['label' => FALSE, 'attr' => ['placeholder' => 'Confirmer le mot de passe']]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
