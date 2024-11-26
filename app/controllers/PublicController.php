<?php

namespace Controller;
use App\Router;

class PublicController {
    public static function explore(Router $router) {
        $router->render('page/explore');
    }
}