<?php

namespace App\Controllers;

use App\Models\User;
use App\Validator;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class UserController
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $this->view->render($response, 'user/home.twig', compact('users'));
    }

    public function store(Request $request, Response $response)
    {
        $validation = Validator::make($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return $this->view->render($response, 'user/home.twig', ['message' => 'Invalid fields', 'errors' => $validation->errors()]);
        }

        $insert = User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_BCRYPT, ['cost' => 12]),
        ]);

        return $this->view->render($response, 'user/home.twig', ['message' => 'Successfull']);
    }
}
