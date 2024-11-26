<?php

namespace App;

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get(string $path, array $function) : void {
        $this->getRoutes[$path] = $function;
    }
    
    public function post(string $path, array $function) : void {
        $this->postRoutes[$path] = $function;
    }

    public function checkRoutes() {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        $routesProtected = [
            '/index',
            '/profile',
            '/logout'
        ];

        $currentURL = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if(in_array($currentURL, $routesProtected) && !$auth) {
            header('Location: /login');
        }

        if($method === 'GET') {
            $fn = $this->getRoutes[$currentURL] ?? null;
        } else if($method === 'POST') {
            $fn = $this->postRoutes[$currentURL] ?? null;
        }

        if($fn) {
            //fn sera una funcion que llamaremos dinamicamente y le pasaremos por parametro los atributos de esta clase
            $fn($this);
        } else {
            //Todo (Agregar vista para una mejor experiencia de usuario)
            echo "Error 404 page not found";
        }
    }

    public function render(string $view, array $data = []) {
        extract($data);//Extraer los datos del array y convertirlos en variables
        ob_start();//Almacenamiento en memoria por un momento(buffer)

        include_once __DIR__ . "/views/{$view}.php";
        $content = ob_get_clean();//obtener y limpiar el buffer
        include_once __DIR__ . "/views/layout.php";
    }
}