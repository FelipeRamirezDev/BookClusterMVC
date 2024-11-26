<?php

namespace Controller;
use App\Router;

class UserController {
    public static function index(Router $router) {
        $posts = [
            [
                'username' => 'lector_aventurero',
                'profile_picture' => IMG_PROFILE_DEFAULT,
                'content' => '¡Acabo de leer un libro increíble! Se llama "El viajero del tiempo". Lo recomiendo mucho.',
                'image' => 'https://via.placeholder.com/600x400',
                'created_at' => 'Hace 2 horas'
            ],
            [
                'username' => 'amante_de_las_letras',
                'profile_picture' => IMG_PROFILE_DEFAULT,
                'content' => 'Hoy reflexioné sobre esta cita: "La literatura es la evidencia de que la vida no basta". ¿Qué opinan?',
                'image' => '',
                'created_at' => 'Hace 4 horas'
            ],
            [
                'username' => 'historias_epicas',
                'profile_picture' => IMG_PROFILE_DEFAULT,
                'content' => 'Aquí les dejo una foto de mi rincón de lectura favorito 📚✨',
                'image' => 'https://via.placeholder.com/600x400',
                'created_at' => 'Ayer'
            ],
            [
                'username' => 'cuentos_y_cafés',
                'profile_picture' => IMG_PROFILE_DEFAULT,
                'content' => '¿Cuál es su género literario favorito? Estoy buscando recomendaciones para mi próxima lectura.',
                'image' => '',
                'created_at' => 'Hace 3 días'
            ]
        ];
        $router->render('user/index', [
            'posts' => $posts
        ]);
    }

    public static function profile(Router $router) {
        $user = $_SESSION['user'];
        $router->render('user/profile', [
            'user' => $user
        ]);
    }

}