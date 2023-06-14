<?php

namespace App\Repositories;

use App\Core\MysqlDbConnector;
use App\Models\User;

class UserRepository
{
    const TABLE = 'users';

    public function create(User $user)
    {
        $query = "INSERT INTO " . self::TABLE . " (name, is_admin, password) VALUES (:name, :is_admin, :password)";
        $stmt = MysqlDbConnector::getInstance()->prepare($query);

        $stmt->bindValue(":name", $user->name);
        $stmt->bindValue(":is_admin", $user->is_admin);
        $stmt->bindValue(":password", $user->password);

        $stmt->execute();
        return MysqlDbConnector::getInstance()->lastInsertId();
    }

    public function findOne(string $condition, array $params)
    {
        $query = "SELECT * FROM " . self::TABLE;

        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }

        $stmt = MysqlDbConnector::getInstance()->prepare($query);
        $stmt->execute($params);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, "App\Models\User");
        return $stmt->fetch();
    }
}