<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;

class TodoListController extends AbstractController
{
    #[Route('/todo/list', name: 'app_todo_list')]
    public function index(ManagerRegistry $doctrine)
    {
        $data = [
            'header' => 'Todo List',
            'description' => 'This is symfony todo list app',
        ];

        /**
         * Order by desc 
         */

        $tasks = $doctrine->getRepository(Task::class)->findBy([], ['id' => 'DESC']);

        $data['tasks'] = $tasks;

        return $this->render('index.html.twig', $data);
    }
    
    #[Route('/todo/create', name: 'app_todo_create', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request)
    {
        $title = $request->request->get('title'); 

        if(!$title)
            return $this->redirectToRoute('app_todo_list');
        
        $task = new Task();
        $task->setTitle($title);

        $doctrine->getManager()->persist($task);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('app_todo_list');

        
    }

    #[Route('/todo/switch-status/{id}', name: 'app_todo_switch_status')]
    public function switchStatus(ManagerRegistry $doctrine, $id)
    {
        $task = $doctrine->getRepository(Task::class)->find($id);

        if(!$task)
            return $this->redirectToRoute('app_todo_list');

        $task->setStatus(!$task->isStatus());

        $doctrine->getManager()->persist($task);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('app_todo_list');
    }

    #[Route('/todo/delete/{id}', name: 'app_todo_delete')]
    public function delete(ManagerRegistry $doctrine, $id)
    {
        $task = $doctrine->getRepository(Task::class)->find($id);

        if(!$task)
            return $this->redirectToRoute('app_todo_list');

        $doctrine->getManager()->remove($task);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('app_todo_list');
    }

}
