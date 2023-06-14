<?php

namespace App\Core;

use Purl\Url;

class Paginator
{
    public $lastPage;

    public function __construct(public int $currentPage, public int $countRecordsPerPage, public int $countTotal)
    {
        $this->lastPage = (int) ceil($countTotal / $countRecordsPerPage);
    }

    public function getPrevPageLink(): string|false
    {
        if ($this->currentPage === 1) {
            return false;
        } else {
            $url = new Url(Url::fromCurrent());
            if ($this->currentPage - 1 > 1) {
                $url->query->set('page', $this->currentPage - 1);
            } else {
                $url->query->remove('page');
            }
            return $url;
        }
    }

    public function getNextPageLink(): string|false
    {
        if ($this->currentPage === $this->lastPage) {
            return false;
        } else {
            $url = new Url(Url::fromCurrent());
            $url->query->set('page', $this->currentPage + 1);
            return $url;
        }
    }
}