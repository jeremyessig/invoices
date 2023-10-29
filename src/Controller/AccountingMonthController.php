<?php

namespace App\Controller;

use App\Entity\AccountingMonth;
use App\Entity\AccountingEntry;
use App\Form\AccountingMonthType;
use App\Form\OutcomeType;
use App\Repository\AccountingMonthRepository;
use App\Repository\AccountingYearRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accounting/month')]
class AccountingMonthController extends AbstractController
{

    public function __construct(
        private AccountingYearRepository $accountingYearRepository
    ) {
    }

    #[Route('/', name: 'app_accounting_month_index', methods: ['GET'])]
    public function index(AccountingMonthRepository $accountingMonthRepository): Response
    {
        return $this->render('accounting_month/index.html.twig', [
            'accounting_months' => $accountingMonthRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accounting_month_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accountingMonth = new AccountingMonth();
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
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounting_month_show', methods: ['GET'])]
    public function show(AccountingMonth $accountingMonth): Response
    {
        return $this->render('accounting_month/show.html.twig', [
            'accounting_month' => $accountingMonth,
            'accounting_year' => $accountingMonth->getAccountingYear()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_accounting_month_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AccountingMonth $accountingMonth, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccountingMonthType::class, $accountingMonth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_month_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_month/edit.html.twig', [
            'accounting_month' => $accountingMonth,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/outcome', name: 'app_accounting_month_entries_edit', methods: ['GET', 'POST'])]
    public function outcome(Request $request, AccountingMonth $accountingMonth, EntityManagerInterface $entityManager): Response
    {
        /** @var Form $form */
        $form = $this->createForm(OutcomeType::class, $accountingMonth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajout l'utilisateur courant à chaque sous formulaires
            foreach ($form->get('accountingEntries') as $subForm) {
                /** @var AccountingEntry $entryForm */
                $entryForm = $subForm->getData();
                $entryForm->setOwner($this->getUser());
                $entryForm->setIsIncome(false);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_month_show', ['id' => $accountingMonth->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_month/outcome.html.twig', [
            'accounting_month' => $accountingMonth,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_accounting_month_delete', methods: ['POST'])]
    public function delete(Request $request, AccountingMonth $accountingMonth, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $accountingMonth->getId(), $request->request->get('_token'))) {
            $entityManager->remove($accountingMonth);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_accounting_month_index', [], Response::HTTP_SEE_OTHER);
    }
}
