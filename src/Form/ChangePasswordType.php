<?php

namespace App\Form;

use App\Entity\ChangePassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => FALSE,
                'required' => true,
                'attr' => ['placeholder' => 'Mot de passe actuel']
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' =>PasswordType::class,
                'label' => FALSE,
                'invalid_message' => "Votre mot de passe doit être identique !",
                'required' => true,
                'first_options' => ['label' => FALSE, 'attr' => ['placeholder' => 'Nouveau mot de passe']],
                'second_options' => ['label' => FALSE, 'attr' => ['placeholder' => 'Confirmer le mot de passe']]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ChangePassword::class,
        ]);
    }
}
