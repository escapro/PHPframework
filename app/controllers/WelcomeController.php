<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\DB;
use App\Models\Post;

class WelcomeController extends Controller
{
    protected $data = [];
    protected $postModel;

    public function __construct()
    {
        // $this->postModel = new Post();
    }

    public function index($qwe)
    {   
        // $users = Post::all();
        // var_dump($users);
        // var_dump(Db::table('posts')->qwe('ads'));
        var_dump(DB::table('post')->select('title', 'fdgfd')->where('id', '=', '17')->where('id', '=', '17')->get());
        // View::render('main', $this->data);
    }

    public function qwe()
    {   
        echo "hello";
    }

}