<?php

namespace App\Controller;

use App\Entity\AccountingEntry;
use App\Form\AccountingEntryType;
use App\Repository\AccountingEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accounting/entry')]
class AccountingEntryController extends AbstractController
{
    #[Route('/', name: 'app_accounting_entry_index', methods: ['GET'])]
    public function index(AccountingEntryRepository $accountingEntryRepository): Response
    {
        return $this->render('accounting_entry/index.html.twig', [
            'accounting_entries' => $accountingEntryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accounting_entry_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $accountingEntry = new AccountingEntry();
        $form = $this->createForm(AccountingEntryType::class, $accountingEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($accountingEntry);
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_entry/new.html.twig', [
            'accounting_entry' => $accountingEntry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounting_entry_show', methods: ['GET'])]
    public function show(AccountingEntry $accountingEntry): Response
    {
        return $this->render('accounting_entry/show.html.twig', [
            'accounting_entry' => $accountingEntry,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_accounting_entry_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AccountingEntry $accountingEntry, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AccountingEntryType::class, $accountingEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_accounting_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('accounting_entry/edit.html.twig', [
            'accounting_entry' => $accountingEntry,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accounting_entry_delete', methods: ['POST'])]
    public function delete(Request $request, AccountingEntry $accountingEntry, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $accountingEntry->getId(), $request->request->get('_token'))) {
            $entityManager->remove($accountingEntry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_accounting_entry_index', [], Response::HTTP_SEE_OTHER);
    }
}
