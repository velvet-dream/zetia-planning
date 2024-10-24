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
            ->add('pctTitle', null, [
                'label' => 'Intitulé',
            ])
            ->add('pctDescription', null, [
                'label' => 'Description',
            ])
            ->add('pctDateDebut', null, [
                'label' => 'Date de début',
                'widget' => 'single_text',
            ])
            ->add('pctDateFinPrevisionnelle', null, [
                'label' => 'Date de fin prévue',
                'widget' => 'single_text',
            ])
            ->add('pctStatus', EntityType::class, [
                'label' => 'Statut',
                'class' => StatusProject::class,
                'choice_label' => 'stpTitle',
                'placeholder' => 'Choisir un statut',
                'required' => true,
            ]);
        // Future dev : we need to be able to add pctDateFinReelle when editing an existing project.

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
