<?php

namespace App\Repositories;

use App\Core\MysqlDbConnector;
use App\Core\Paginator;
use App\Core\Sorting;
use App\Models\Task;

class TaskRepository
{
    const TABLE = 'tasks';
    const SORTINGS = [
        'name', 'email', 'completed'
    ];

    public ?string $sort = null;
    public ?string $sortDirection = null;

    public function __construct(?string $sortRequest = null)
    {
        if ($sortRequest) {
            $this->initSort($sortRequest);
        }
    }

    private function initSort($sortRequest)
    {
        $sorting = new Sorting($sortRequest, self::SORTINGS);

        $sortInfo = $sorting->getSort();
        if ($sortInfo) {
            list($this->sort, $this->sortDirection) = $sortInfo;
        }
    }

    public function create(Task $task): int|false
    {
        $query = "INSERT INTO " . self::TABLE . " (name, email, title) VALUES (:name, :email, :title)";
        $stmt = MysqlDbConnector::getInstance()->prepare($query);

        $stmt->bindValue(":name", $task->name);
        $stmt->bindValue(":email", $task->email);
        $stmt->bindValue(":title", $task->title);

        $stmt->execute();
        return (int) MysqlDbConnector::getInstance()->lastInsertId();
    }

    public function findOne(?string $condition = null, array $params = []): Task
    {
        $query = "SELECT * FROM " . self::TABLE;

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        $stmt = MysqlDbConnector::getInstance()->prepare($query);
        $stmt->execute($params);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, "App\Models\Task");
        return $stmt->fetch();
    }

    public function findAll(int $pageNum, int $count, ?string $condition = null, array $params = []): array
    {
        $query = "SELECT * FROM " . self::TABLE;

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        if ($this->sort) {
            $query .= " ORDER BY {$this->sort} {$this->sortDirection}";
        }

        $offset = ($pageNum - 1) * $count;
        $query .= " LIMIT {$count} OFFSET  {$offset}";

        $stmt = MysqlDbConnector::getInstance()->prepare($query);

        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "App\Models\Task");
    }

    public function update(Task $task): int
    {
        $query = "UPDATE " . self::TABLE . " SET title = :title, completed = :completed WHERE id = :id";
        $stmt = MysqlDbConnector::getInstance()->prepare($query);

        $stmt->bindValue(":title", $task->title);
        $stmt->bindValue(":completed", (int) $task->completed);
        $stmt->bindValue(":id", $task->id);

        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getCount(): int
    {
        $query = "SELECT COUNT(*) FROM " . self::TABLE;
        $stmt = MysqlDbConnector::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function getSortDirection(): ?string
    {
        return $this->sortDirection;
    }

}