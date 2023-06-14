<?php

namespace App\Core;

use App\Core\Interfaces\RedirectInterface;
use App\Exceptions\ApplicationException;
use App\Core\Interfaces\RenderableInterface;
use App\Core\Router;
use App\Core\View;

class Application
{
    public function __construct(private Router $router)
    {
        $this->router = $router;
    }

    public function run(string $url, string $method)
    {
        $this->emptyTemporarySession();

        try {
            $out = $this->router->fetch($url, $method);

            if ($out instanceof RenderableInterface) {
                $out->render();
            } else if ($out instanceof RedirectInterface) {
                $out->redirect();
            } else {
                echo $out;
            }
        } catch (ApplicationException $e) {
            $this->renderException($e);
        }
    }

    public function emptyTemporarySession()
    {
        unset($_SESSION['error_form']);
        unset($_SESSION['success_form']);
    }

    private function renderException(ApplicationException $e)
    {
        if ($e instanceof RenderableInterface) {
            $e->render();
        } else {
            http_response_code(empty($e->getCode()) ? 500 : $e->getCode());

            $view = new View('error', ['title' => $e->getMessage()]);
            $view->render();
        }
    }
}