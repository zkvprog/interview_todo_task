<?php

namespace App\Controllers;

use App\Core\Paginator;
use App\Core\Redirect;
use App\Core\View;
use App\Exceptions\ApplicationException;
use App\Models\Task;
use App\Repositories\TaskRepository;

class AdminController
{
    public function index()
    {
        if (empty($_SESSION['admin'])) {
            return new Redirect();
        }

        $sortRequest = $_GET['sort'] ?? null;
        $pageRequest = $_GET['page'] ?? 1;

        $taskRepository = new TaskRepository($sortRequest);
        $tasks = $taskRepository->findAll($pageRequest, 10);

        $sort = $taskRepository->getSort();
        $sortDirection = $taskRepository->getSortDirection();

        $paginator = new Paginator($pageRequest, 10, $taskRepository->getCount());

        return (new View('admin', compact('tasks', 'sort', 'sortDirection', 'paginator')));
    }

    public function editTask()
    {
        $taskId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if ($taskId) {
            $taskRepository = new TaskRepository();
            $task = $taskRepository->findOne('id=:id', ['id' => $taskId]);
        } else {
            throw new ApplicationException('undefined task');
        }

        return (new View('edit_task', compact('task')));
    }

    public function updateTask()
    {
        $taskId = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        $title = htmlspecialchars($_POST['title']);

        $taskRepository = new TaskRepository();
        $task = $taskRepository->findOne('id=:id', ['id' => $taskId]);
        $task->title = $title;
        $task->completed = (bool) $_POST['completed'];
        $taskRepository->update($task);

        return new Redirect('/admin');

    }
}