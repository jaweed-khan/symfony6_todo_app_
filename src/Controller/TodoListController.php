<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TodoListController extends AbstractController
{
    #[Route('/todo/list', name: 'app_todo_list')]
    public function index()
    {
        $data = [
            'header' => 'Todo List',
            'description' => 'This is symfony todo list app',
        ];

        return $this->render('index.html.twig', $data);
    }

}
