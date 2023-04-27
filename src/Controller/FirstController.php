<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first/{section<[0-1]?\d{1,2}>}', name: 'app_first'
        //, defaults: ['section' => 'GL2' ]
        //, requirements: ['section' => '[0-1]?\d{1,2}' ]
    )]
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

    #[Route('/hello', name: 'app_hello')]
    public function sayHello(): Response
    {
        return $this->render('first/hello.html.twig');
    }

    public function sayHello2(): Response
    {
//        todo chercher le user de la base de données
        $user = 'aymen';
        return $this->render('fragments/hello.html.twig', [
            'flen' => $user
        ]);
    }

}
