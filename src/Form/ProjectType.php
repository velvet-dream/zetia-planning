<?php
namespace App\Form;

use App\Entity\Project;
use App\Entity\StatusProject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pctTitle')
            ->add('pctDescription')
            ->add('pctDateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('pctDateFinPrevisionnelle', null, [
                'widget' => 'single_text',
            ])
            ->add('pctDateFinReelle', null, [
                'widget' => 'single_text',
            ])
            ->add('pctStatus', EntityType::class, [
                'class' => StatusProject::class,
                'choice_label' => 'stpTitle',
                'placeholder' => 'Choisir un statut',
                'required' => true,
            ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
