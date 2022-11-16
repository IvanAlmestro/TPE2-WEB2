<?php

class StudentModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_universidad;charset=utf8', 'root', '');
    }
    //trae todos los estudiantes
    function getAllStudents($params){
        $query = $this->db->prepare("SELECT * 
                                     FROM `estudiantes` 
                                     INNER JOIN `carreras_grado` 
                                     on estudiantes.carrera_id = carreras_grado.id_carrera
                                     WHERE estudiantes.carrera_id = $params[where]
                                     ORDER BY $params[field] $params[sort]
                                     LIMIT $params[limit]
                                     OFFSET $params[offset]");

        $query->execute();
        $students = $query->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }
    //trae estudiante segun el id
    function getStudentId($id){
        $query = $this->db->prepare("SELECT * 
                                     FROM `estudiantes`
                                     INNER JOIN `carreras_grado` 
                                     on estudiantes.carrera_id = carreras_grado.id_carrera 
                                     WHERE estudiantes.id = ?");

        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //agrega estudiante
    public function addStudents($nombre, $edad, $dni, $carrera){
    
        $query = $this->db->prepare("INSERT INTO `estudiantes` (nombre, edad, dni, carrera_id)  
                                     VALUES(?,?,?,?)");
        $query->execute([$nombre, $edad, $dni, $carrera]);

        return $this->db->lastInsertId();
    }

}
