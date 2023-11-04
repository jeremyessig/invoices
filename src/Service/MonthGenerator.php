<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AccountingMonth;
use App\Entity\AccountingYear;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class MonthGenerator
{
    private DateTimeImmutable $startDate;

    private DateTimeImmutable $endDate;

    private AccountingYear $accountingYear;


    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function generate(DateTimeImmutable $start, DateTimeImmutable $end, AccountingYear $year): void
    {
        $this->init($start, $end, $year);
        dd($this->createMonthsDateTime());
    }

    public function setStartDate(DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setEndDate(DateTimeImmutable $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setAccountingYear(AccountingYear $accountingYear): void
    {
        $this->accountingYear = $accountingYear;
    }

    private function init(DateTimeImmutable $start, DateTimeImmutable $end, AccountingYear $year): void
    {
        $this->setStartDate($start);
        $this->setEndDate($end);
        $this->setAccountingYear($year);
    }

    /**
     * Retourne un tableau avec le mois de départ et celui de fin sous forme d'entier
     *
     * @return array
     */
    private function getMonthIntegers(): array
    {
        return [intval(($this->startDate->format('m'))), intval(($this->endDate->format('m')))];
    }

    /**
     * Retourne un tableau avec la liste des mois sous forme d'entiers entre la date de début et celle de fin
     *
     * @return array
     */
    private function getDatesInterval(): array
    {
        $months = [];

        for ($i = $this->getMonthIntegers()[0]; $i <= $this->getMonthIntegers()[1]; $i++) {
            $months[] = $i;
        }

        return $months;
    }

    /**
     * Retourne un tableau des mois sous forme de AccountingMonth
     *
     * @return array
     */
    private function createMonthsDateTime(): array
    {
        $months = [];

        $monthsInteger = $this->getDatesInterval();


        foreach ($monthsInteger as $monthInteger) {
            $accountingMonth = new AccountingMonth;
            $startDate = new DateTimeImmutable();
            $startDate = $startDate->setDate(2023, $monthInteger, 1);

            $endDate = new DateTimeImmutable();
            $endDate = $endDate->setDate(2023, $monthInteger, 20);

            $accountingMonth->setStartAt($startDate);
            $accountingMonth->setEndAt($endDate);
            $accountingMonth->setLabel($startDate->format('M'));
            $accountingMonth->setAccountingYear($this->accountingYear);
            $months[] = $accountingMonth;
        }

        return $months;
    }
}
