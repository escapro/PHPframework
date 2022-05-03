<?php

namespace App\Middlewares;

use App\Core\Middleware;

class CheckAge extends Middleware
{
    public function handle()
    {
       echo "CheckAge";
    }
}
