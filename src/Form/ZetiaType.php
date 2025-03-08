<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// ZetiaType adds configuration features to Abstract type
class ZetiaType extends AbstractType
{
    protected ?array $fields = [];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($this->fields as $field) {
            if (count($options['only_fields']) > 0) {
                if (!in_array($field, $options['only_fields'])) {
                    $builder->remove($field);
                }
            } else {
                if (in_array($field, $options['exclude_fields'])) {
                    $builder->remove($field);
                }
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // exclude specified fields if only_fields is empty
            'exclude_fields' => [],
            // exclude all fields from $this->fields except these ones
            'only_fields' => []
        ]);

        $resolver
            ->setAllowedTypes('exclude_fields', 'array')
            ->setAllowedTypes('only_fields', 'array');
    }
}
