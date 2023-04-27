<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(SessionInterface $session): Response
    {
    //        Todo Gérer la page d'accueil
        if (!$session->has('todos')) {
            $todos = array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            );
            $session->set('todos', $todos);
            $this->addFlash('info', 'Bienvenu dans le gestionnaire de todos');
        }
        return $this->render('todo/index.html.twig');
    }
    #[Route('/delete/{name}', name: 'app_todo_delete')]
    public function deleteTodo(SessionInterface $session, $name): Response
    {
    //        Todo Gérer la page d'accueil
        if ($session->has('todos')) {
            $todos = $session->get('todos');
            if(isset($todos[$name])) {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo $name a été supprimé avec succès");
            } else {
                $this->addFlash('error', "Le todo $name n'existe pas");
            }
        } else {
            $this->addFlash('error', "Rabi iehdik hakka tawa :D");
        }
        return $this->redirectToRoute('app_todo');
    }
}
