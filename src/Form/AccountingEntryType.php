<?php

namespace App\Form;

use App\Entity\AccountingEntry;
use App\Entity\AccountingTag;
use App\Entity\User;
use App\Form\AutocompleteField\TagAutocompleteField;
use DateTimeImmutable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountingEntryType extends AbstractType
{
    public function __construct(private Security $security)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('amount')
            ->add('label')
            //->add('description')
            //->add('isIncome')
            //->add('accountingMonth', HiddenType::class)
            // ->add('owner', CollectionType::class, [
            //     'entry_type' => UserType::class,
            //     'empty_data' => $this->security->getUser()
            // ])
            ->add('accountingCategory')
            //->add('accountingTags', TagAutocompleteField::class);
            ->add('accountingTags', EntityType::class, [
                'class' => AccountingTag::class,
                'autocomplete' => true,
                'choice_label' => 'label',
                'multiple' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AccountingEntry::class,
        ]);
    }
}
