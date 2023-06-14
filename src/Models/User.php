<?php

namespace App\Models;

class User
{
    public ?int $id;
    public string $name;
    public bool $is_admin;
    public string $password;

    public static function createFromArray(array $data): self
    {
        $task = new self();
        $task->id =  $data['id'] ?? null;
        $task->name   =  $data['name'];
        $task->is_admin  =  $data['is_admin'];
        $task->password  =  $data['password'];

        return $task;
    }
}