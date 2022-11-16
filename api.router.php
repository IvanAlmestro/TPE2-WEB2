<?php
require_once './libs/router.php';
require_once './app/controllers/api.student.controller.php';
require_once './app/controllers/api.user.controller.php';

//Se define base URL para utilizar una URL semántica.
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
// creacion del router
$router = new Router();


//tabla de ruteo de los estudiantes

//listar todos los  estudiantes
$router->addRoute('students', 'GET', 'ApiStudentController', 'getStudents');
//listar 1 estudiante (pasando como parametro el id) 
$router->addRoute('students/:ID', 'GET', 'ApiStudentController', 'showStudentById');
// agregar estudiante
$router->addRoute('students', 'POST', 'ApiStudentController', 'addStudent'); 

//validacion de usuario mediante un token
$router->addRoute('token', 'GET', 'AuthApiController', 'getToken');

// ejecucion de la ruta
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);