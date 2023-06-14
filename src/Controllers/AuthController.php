<?php

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\View;
use App\Exceptions\ApplicationException;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthController
{
    public function index()
    {
        return (new View('auth', []));
    }

    /*public function signup()
    {
        $data = [
            'name' => 'admin',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'is_admin' => true,
        ];

        $user = User::createFromArray($data);
        $userRepository = new UserRepository();
        $_SESSION['user_id'] = $userRepository->create($user);
        $_SESSION['admin'] = true;

        return new Redirect('/admin');
    }*/

    public function login()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOne('name=:name', ['name' => $_POST['login']]);

        if (!empty($user)) {
            if (password_verify($_POST['password'], $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['admin'] =  $user->is_admin;
            } else {
                throw new ApplicationException('incorrect password');
            }
        } else {
            throw new ApplicationException('undefined user');
        }

        return new Redirect('/admin');
    }

    public function logout()
    {
        session_destroy();
        return new Redirect();
    }
}