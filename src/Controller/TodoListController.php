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

    #[Route('/todo/create', name: 'app_todo_create', methods: ['POST'])]
    public function create()
    {
        exit('to do: create a new task');
    }

    #[Route('/todo/switch-status/{id}', name: 'app_todo_switch_status')]
    public function switchStatus($id)
    {
        exit('to do: switch status of a task'. $id);
    }

    #[Route('/todo/delete/{id}', name: 'app_todo_delete')]
    public function delete($id)
    {
        exit('to do: delete a task'. $id);
    }

}
