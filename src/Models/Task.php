<?php

namespace App\Models;

class Task
{
    public ?int $id;
    public string $name;
    public string $email;
    public string $title;
    public int $completed;

    public static function createFromArray(array $data): self
    {
        $task = new self();
        $task->id =  $data['id'] ?? null;
        $task->name   =  $data['name'];
        $task->email  =  $data['email'];
        $task->title  =  $data['title'];
        $task->completed = $data['completed'] ?? false;

        return $task;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}