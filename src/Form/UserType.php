<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usrName', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('usrFirstName', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('usrMail', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('usrPassword', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('usrRole', ChoiceType::class, [
                'choices' => [
                    'Responsable' => 'ROLE_ADMIN',
                    'Salarié' => 'ROLE_USER',
                ],
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
