<?php
define('IMG_PROFILE_DEFAULT', "img/users/profile/default.png");
define('IMG_COVER_DEFAULT', "img/users/cover/default.png");
/**
 * Muestra el valor de una variable de cualquier tipo en un buen estilo
 */
function debug(mixed $variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}