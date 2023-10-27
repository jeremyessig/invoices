<?php

namespace App\Form;

use App\Entity\AccountingYear;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountingYearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'label' => 'Libellé'
            ])
            ->add('monthAutoGenerate', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Générer automatiquement les mois'
            ])
            ->add('startAt', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'label' => 'Commencer l\'année au:'
            ])
            ->add('endAt', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'label' => 'Terminer l\'année au:'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AccountingYear::class,
        ]);
    }
}
