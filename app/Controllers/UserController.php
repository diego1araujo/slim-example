<?php

namespace App\Controllers;

use App\Models\User;
use Slim\Views\Twig as View;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $this->view->render($response, 'user/home.twig', compact('users'));
    }

    public function store()
    {
        $users = [
            [
                'name' => 'User 01',
                'email' => 'user01@test.com',
            ],
            [
                'name' => 'User 02',
                'email' => 'user02@test.com',
            ],
            [
                'name' => 'User 03',
                'email' => 'user03@test.com',
            ]
        ];

        $insert = User::insert($users);
    }
}
