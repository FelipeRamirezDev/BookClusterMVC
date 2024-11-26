<?php

namespace Model;

use PDO;

class User extends ActiveRecord {
    protected static string $tableName = 'users';
    protected static array $columns = ['id', 'username', 'email', 'password', 'profile_picture', 'cover_photo', 'bio', 'created_at'];

    public int $id;
    public string $username;
    public string $email;
    public string $password;
    public string $profile_picture;
    public string $cover_photo;
    public string $bio;
    public string $created_at;

    public function __construct(array $values = []) {
        $this->id = $values['id'] ?? 0;
        $this->username = $values['username'] ?? '';
        $this->email = $values['email'] ?? '';
        $this->password = $values['password'] ?? '';
        $this->profile_picture = $values['profile_picture'] ?? '';
        $this->cover_photo = $values['cover_photo'] ?? '';
        $this->bio = $values['bio'] ?? '';
        $this->created_at = $values['created_at'] ?? date('Y-m-d H:i:s');
    }

    public function validateLogin() {
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }
    
    public function validateSignup() {
        if(!$this->username){
            self::$alertas['error'][] = 'El username es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function userExist() {
        $query = "SELECT * FROM " . self::$tableName . " WHERE email = :email";
        $statement = self::$db->prepare($query);
        $statement->bindParam(':email', $this->email);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        if($resultado)
            $this->convertToObject($resultado);

        return $resultado ?? false;
    }

}