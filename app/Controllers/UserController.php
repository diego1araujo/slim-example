<?php

namespace App\Controllers;

use App\Models\User;
use App\Validator;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    public function index(Request $request, Response $response)
    {
        $users = User::all();

        return $response->withJson(['data' => $users], 200);
    }

    public function store(Request $request, Response $response)
    {
        $validation = Validator::make($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validation->fails()) {
            return $response->withJson(['data' => 'Invalid fields.', 'errors' => $validation->errors()], 400);
        }

        $field = $request->getParams();

        $insert = User::insert([
            'name' => $field['name'],
            'email' => $field['email'],
            'password' => password_hash($field['password'], PASSWORD_BCRYPT, ['cost' => 12]),
        ]);

        return $response->withJson(['data' => 'Successfull.'], 200);
    }
}
