<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\StatusTask;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tskTitle', null, [
                'label' => 'Titre',
            ])
            ->add('tskDescription', null, [
                'label' => 'Description',
            ])
            ->add('tskDateDebut', null, [
                'widget' => 'single_text',
                'label' => 'Date de début',
            ])
            ->add('tskDateFinPrevisionnelle', null, [
                'label' => 'Date de fin prévue',
                'widget' => 'single_text',
            ])
            ->add('tskStatus', EntityType::class, [
                'label' => 'Statut',
                'class' => StatusTask::class,
                'choice_label' => 'stkTitle',
                'placeholder' => 'Choisissez un statut',
            ])
            ->add('project', EntityType::class, [
                'label' => 'Projet',
                'class' => Project::class,
                'choice_label' => 'pctTitle',
                'placeholder' => 'Sélectionner un projet',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
