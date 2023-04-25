<?php

namespace App\Form;

use App\Entity\Diagnostico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Pato;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DiagnosticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('notas')
            ->add('paciente')
        //    ->add('patologias', )

            ->add('patologias',EntityType::class, [
                // looks for choices from this entity
                'class' => Pato::class,
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diagnostico::class,
        ]);
    }
}
