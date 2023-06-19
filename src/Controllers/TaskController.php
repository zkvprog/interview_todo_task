<?php

namespace App\Controllers;

use App\Core\Paginator;
use App\Core\Redirect;
use App\Core\View;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController
{
    const COUNT_PER_PAGE = 3;

    public function index()
    {
        $sortRequest = $_GET['sort'] ?? null;
        $pageRequest = $_GET['page'] ?? 1;

        $taskRepository = new TaskRepository($sortRequest);
        $tasks = $taskRepository->findAll($pageRequest, self::COUNT_PER_PAGE);

        $sort = $taskRepository->getSort();
        $sortDirection = $taskRepository->getSortDirection();

        $paginator = new Paginator($pageRequest, self::COUNT_PER_PAGE, $taskRepository->getCount());

        return (new View('home', compact('tasks', 'sort', 'sortDirection', 'paginator')));
    }

    public function create()
    {
        $data = [
            'name' => strip_tags($_POST['name']),
            'email' => strip_tags($_POST['email']),
            'title' => strip_tags($_POST['title'])
        ];

        $task = Task::createFromArray($data);
        $taskRepository = new TaskRepository();
        if ($taskId = $taskRepository->create($task)) {
            $task->setId($taskId);
        }

        return new Redirect();
    }
}