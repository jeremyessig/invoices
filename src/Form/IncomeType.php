<?php

namespace App\Form;

use App\Entity\AccountingEntry;
use App\Entity\AccountingMonth;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class IncomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('incomes', LiveCollectionType::class, [
                'entry_type' => AccountingEntryType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            // ->add('label', null)
            // ->add('startAt', null)
            // ->add('endAt', null)
            // ->add('accountingYear', null);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AccountingMonth::class,
        ]);
    }
}
