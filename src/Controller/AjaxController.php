<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ajax')]
class AjaxController extends AbstractController
{
    // #[Route('/year/new', name: 'app_ajax_new_year')]
    // public function createYear(): Response
    // {
    //     return $this->render('ajax/index.html.twig', [
    //         'controller_name' => 'AjaxController',
    //     ]);
    // }
}
