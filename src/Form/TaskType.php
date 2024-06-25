<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\StatusTask;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tskTitle')
            ->add('tskDateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('tskDateFinPrevisionnelle', null, [
                'widget' => 'single_text',
            ])
            ->add('tskDateFinReelle', null, [
                'widget' => 'single_text',
            ])
            ->add('tskDescription')
            ->add('tskDuree')
            ->add('tskStatus', EntityType::class, [
                'class' => StatusTask::class,
                'choice_label' => 'stkTitle',
                'placeholder' => 'Status',
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'pctTitle', // Remplacez par le champ de votre projet à afficher
                'placeholder' => 'Sélectionner un projet',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
