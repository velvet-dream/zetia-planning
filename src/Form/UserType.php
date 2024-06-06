<?php
// src/Form/UserType.php
// src/Form/UserType.php
namespace App\Form;

use App\Entity\Poste;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('usr_name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('usr_first_name', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('usr_mail', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('usr_password', PasswordType::class, [
                'label' => 'Mot de passe',
            ])
            ->add('usr_role', ChoiceType::class, [
                'choices' => [
                    'Responsable' => 'ROLE_ADMIN',
                    'Salarier' => 'ROLE_USER',
                    
                ],
            ])
            ->add('pst_id', EntityType::class, [ 
                'class' => Poste::class, 
                'choice_label' => 'titre', 
                'label' => 'Post ID',
            ]);
    }
            
    

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
