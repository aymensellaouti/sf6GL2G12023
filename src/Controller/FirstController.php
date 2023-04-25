<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first/{section}', name: 'app_first')]
    public function index($section, Request $request, SessionInterface $session): Response
    {
        if ($session->has('nbVisite')) {
            $nbVisite = $session->get('nbVisite');
            $nbVisite++;
            $message = "Merci pour votre fidélité c'est votre $nbVisite visites";
            $session->set('nbVisite', $nbVisite);
        } else {
            $message = "Bienvenu";
            $this->addFlash('success', 'Hello');
            $session->set('nbVisite', 1);
        }
        return $this->render('first/index.html.twig', [
            'controller_name' => $section,
            'message' => $message
        ]);
    }
}
