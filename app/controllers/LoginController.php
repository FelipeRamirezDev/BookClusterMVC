<?php

namespace Controller;
use App\Router;
use Model\User;

class LoginController {
    public static function home(Router $router) {
        $router->render('page/home');
    }

    public static function login(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alertas = $user->validateLogin();

            if(empty($alertas)) {
                $result = $user->userExist();

                if($result) {
                    if(password_verify($user->password, $result['password'])) {
                        session_start();
                        $_SESSION['user'] = $result;
                        $_SESSION['login'] = true;

                        header('Location: /index');
                    } else {
                        $alertas['error'][] = 'Credenciales no validas';
                    }
                } else {
                    $alertas['error'][] = 'Credenciales no validas';
                }
            }
        }

        $router->render('auth/login', [
            'user' => $user ?? new User(),
            'alertas' => $alertas ?? []
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /');
    }

    public static function signup(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alertas = $user->validateSignup();

            if(empty($alertas)) {
                $result = $user->userExist();
                if(!$result) {
                    $user->password = password_hash($user->password, PASSWORD_BCRYPT);
                    $user->create();
                    
                    session_start();
                    $_SESSION['user'] = $user;
                    $_SESSION['login'] = true;

                    header('Location: /index');
                } else {
                    $alertas['error'][] = 'El usuario ya existe';
                }
            }
        }
        $router->render('auth/signup', [
            'user' => $user ?? new User(),
            'alertas' => $alertas ?? []
        ]);
    }

    //Todo
    public static function forgetPassword(Router $router) {
        $router->render('auth/forget-password');
    }
}