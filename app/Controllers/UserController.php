<?php

namespace App\Controllers;

use App\Models\User;
use App\Validator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use Slim\Views\Twig as View;

class UserController
{
    protected $view;
    protected $validator;

    public function __construct(View $view, Validator $validator)
    {
        $this->view = $view;
        $this->validator = $validator;
    }

    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $this->view->render($response, 'user/home.twig', compact('users'));
    }

    public function store(Request $request, Response $response)
    {
        $rules = [
            'name' => v::noWhiteSpace()->notEmpty()->alpha(),
            'email' => v::noWhiteSpace()->notEmpty()->email(),
            'password' => v::noWhiteSpace()->notEmpty()->length(8, null),
        ];

        $validation = $this->validator->validate($request, $rules);

        var_dump($validation->fails());
        var_dump($validation->errors());

        // $users = [
        //     [
        //         'name' => 'User 01',
        //         'email' => 'user01@test.com',
        //     ],
        //     [
        //         'name' => 'User 02',
        //         'email' => 'user02@test.com',
        //     ],
        //     [
        //         'name' => 'User 03',
        //         'email' => 'user03@test.com',
        //     ]
        // ];

        // $insert = User::insert($users);
    }
}
