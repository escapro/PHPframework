<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Security;
// use App\Core\Dev;
use App\Core\Cookie;
use App\Models\Post;
use App\Core\Session;
use App\Core\Input;

class WelcomeController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index()
    {   
        echo Input::post('q');

        View::render('main', $this->data);
    }

    public function post()
    {   
        echo "hello";
    }

}