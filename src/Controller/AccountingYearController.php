<?php

namespace App\Controller;

use App\Entity\AccountingYear;
use App\Form\AccountingYearType;
use App\Repository\AccountingYearRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accounting/year')]
class AccountingYearController extends AbstractController
{
    #[Route('/', name: 'app_accounting_year_index', methods: ['GET'])]
    public function index(AccountingYearRepository $accountingYearRepository): Response
    {
        return $this->render('accounting_year/index.html.twig', [
            'accounting_years' => $accountingYearRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accounting_year_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accountingYear = new AccountingYear();
        $accountingYear->setStartAt(new DateTimeImmutable());
        $accountingYear->setOwner($this->getUser());
        $form = $this->createForm(AccountingYearType::class, $accountingYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accountingYear);
            $entityManager->flush();

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
