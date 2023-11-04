<?php

namespace App\Controller;

use App\Entity\AccountingMonth;
use App\Entity\AccountingYear;
use App\Form\AccountingMonthType;
use App\Form\AccountingYearType;
use App\Repository\AccountingMonthRepository;
use App\Repository\AccountingYearRepository;
use App\Service\MonthGenerator;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accounting/year')]
class AccountingYearController extends AbstractController
{

    public function __construct(
        private AccountingYearRepository $accountingYearRepository,
        private AccountingMonthRepository $accountingMonthRepository
    ) {
    }

    #[Route('/', name: 'app_accounting_year_index', methods: ['GET'])]
    public function index(AccountingYearRepository $accountingYearRepository): Response
    {
        return $this->render('accounting_year/index.html.twig', [
            'accounting_years' => $accountingYearRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accounting_year_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MonthGenerator $monthGenerator): Response
    {
        $accountingYear = new AccountingYear();
        $accountingYear->setStartAt(new DateTimeImmutable(date('Y') . '-01-01'));
        $accountingYear->setEndAt(new DateTimeImmutable(date('Y') . '-12-31'));
        $accountingYear->setOwner($this->getUser());
        $form = $this->createForm(AccountingYearType::class, $accountingYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var AccountingYear $year */
            $year = $form->getData();
            $monthGenerator->generate($year->getStartAt(), $year->getEndAt(), $year);

            $entityManager->persist($accountingYear);
            //$entityManager->flush();

            return $this->redirectToRoute('app_accounting_year_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_year/new.html.twig', [
            'accounting_year' => $accountingYear,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounting_year_show', methods: ['GET'])]
    public function show(AccountingYear $accountingYear): Response
    {
        return $this->render('accounting_year/show.html.twig', [
            'accounting_year' => $accountingYear,
        ]);
    }


    #[Route('/{id}/month', name: 'app_accounting_year_month_show', methods: ['GET'])]
    public function monthIndex(AccountingYear $accountingYear): Response
    {
        $accountingMonth = $this->accountingMonthRepository->findByYear($accountingYear);
        return $this->render('accounting_year/months.html.twig', [
            'accounting_months' => $accountingMonth,
            'accounting_year' => $accountingYear,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_accounting_year_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AccountingYear $accountingYear, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccountingYearType::class, $accountingYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_year_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_year/edit.html.twig', [
            'accounting_year' => $accountingYear,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/month/new', name: 'app_accounting_year_month_new', methods: ['GET', 'POST'])]
    public function newMonth(Request $request, AccountingYear $accountingYear, EntityManagerInterface $entityManager): Response
    {

        $accountingMonth = new AccountingMonth();
        $accountingMonth->setAccountingYear($accountingYear);
        $accountingMonth->setOwner($this->getUser());
        $form = $this->createForm(AccountingMonthType::class, $accountingMonth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accountingMonth);
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_month_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_month/new.html.twig', [
            'accounting_month' => $accountingMonth,
            'accounting_year' => $accountingYear,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounting_year_delete', methods: ['POST'])]
    public function delete(Request $request, AccountingYear $accountingYear, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $accountingYear->getId(), $request->request->get('_token'))) {
            $entityManager->remove($accountingYear);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_accounting_year_index', [], Response::HTTP_SEE_OTHER);
    }
}
