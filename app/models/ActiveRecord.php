<?php

namespace Model;

use PDO;

class ActiveRecord {
    protected static string $tableName = '';
    protected static string $primaryKey = 'id';
    protected static array $columns = [];
    protected static PDO $db;
    protected static $alertas = [];

    public function __construct(array $values = []) {
        $this->load($values);
    }

    /**
     * sincroniza las propiedades de la instancia con los valores que se pasan por parametro
     * @param array $values valores de las columnas de la tabla
     */
    public function load(array $values) : void {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Establece la conexion a la base de datos
     * @param PDO $conn conexion a la base de datos
     */
    public static function setConnection(PDO $conn) : void {
        self::$db = $conn;
    }

    //itera sobre los atributos de la clase y los retorna en forma de arreglo
    public function atributos() : array {
        $atributos = [];

        foreach(static::$columns as $column) {
            if($column == 'id') continue;
            $atributos[$column] = $this->$column;
        }
        return $atributos;
    }

    //de array assoc a object
    protected static function convertToObject(array $registro) : object {
        //crea una instancia de la clase que la esta llamando
        $object = new static;
        foreach($registro as $key => $value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }

        return $object;
    }

    public function create() : int {
        $atributos = $this->atributos();

        $query = "INSERT INTO " . static::$tableName . "( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( ";
        $query .= ":" . join(", :", array_keys($atributos));
        $query .= " )";

        $statement = self::$db->prepare($query);
        $this->bindParamAll($statement);
        $succesfull = $statement->execute(); 

        return $succesfull;
    }

    public function update() : int {
        $atributos = $this->atributos();
        foreach(array_keys($atributos) as $key){
            $values[] = "{$key} = :{$key}";
        }

        $query = "UPDATE " . static::$tableName . " SET ";
        $query .= join(", ", $values); 
        $query .= " WHERE id = :id";

        $statement = self::$db->prepare($query);
        $this->bindParamAll($statement);
        $succesfull =  $statement->execute();
        return $succesfull;
    }

    public function delete($id) {
        $statement = self::$db->prepare("DELETE FROM " . static::$tableName . " WHERE id = :id");
        $succesfull = $statement->execute([":id" => $id]);
        return $succesfull;
    }

    /**
     * Obtiene todos los registros de la tabla
     */
    public static function all() : array {
        $query = "SELECT * FROM " . static::$tableName;
        $statement = self::$db->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    /**
     * Obtiene un registro de la tabla por su id
     * @param string $id id del registro
     */
    public static function find(string $id) : ?self {
        $query = "SELECT * FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = :id";
        $statement = self::$db->prepare($query);
        $statement->execute(['id' => $id]);
        return $statement->fetch(PDO::FETCH_CLASS, static::class);
    }

    //sanitizar todos los datos
    protected function bindParamAll(&$statement) : void {
        foreach (static::$columns as $column) {
            if ($column == 'id' && empty($this->id)) continue; // Evitar id nulo en nuevas inserciones
            $statement->bindValue(':'. $column, $this->$column);
        }
    }
}