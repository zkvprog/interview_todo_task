<?php

namespace App\Core;

class Sorting
{
    protected array $sortList;
    protected string $sort;
    protected string $direction;

    public function __construct(string $sortRequest, array $sortList)
    {
        list($this->sort, $this->direction) = explode('_', htmlspecialchars(strtolower($sortRequest)));
        $this->sortList = $sortList;
    }

    public function getSort(): array|null
    {
        if (in_array($this->sort, $this->sortList)) {
            return [$this->sort, $this->direction];
        }

        return null;
    }

}