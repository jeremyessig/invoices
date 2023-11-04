<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig;


use App\Entity\AccountingMonth;
use App\Form\AccountingMonthType;
use App\Form\IncomeType;
use App\Form\OutcomeType;
use App\Form\TransactionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
class AccountingEntryForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?AccountingMonth $accountingMonth;

    protected function instantiateForm(): FormInterface
    {

        if ($this->getFormName() === "outcome") {
            return $this->createForm(
                OutcomeType::class,
                $this->accountingMonth
            );
        }
        return $this->createForm(
            IncomeType::class,
            $this->accountingMonth
        );
    }
}
