<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        return $response->withJson(['data' => 'Index Page.'], 200);
    }
}
