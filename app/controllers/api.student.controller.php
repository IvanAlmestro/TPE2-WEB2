<?php
require_once './app/models/student.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/api.helper.php';

class ApiStudentController {

    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct() {
        $this->model = new StudentModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }


    public function getStudents($params = null){
        //se define parametros por defecto en caso de omitir algun campo.
        $params=[ 
            "sort" => "asc",
            "field" => "id",
            "where" => "estudiantes.carrera_id",
            "limit" => "18446744073709551610",
            "offset"=> "0"
        ];
        if(isset($_GET["field"])){
            $params["field"]= $_GET["field"];
        }
        if(isset($_GET["sort"])){
            $params["sort"]= $_GET["sort"];
        }
        if(isset($_GET["where"])){
            $params["where"]= $_GET["where"];
        }
        if (isset($_GET['limit'])){
            $params["limit"] = $_GET['limit'];
            if (isset($_GET['offset'])){
                $params["offset"] = ($_GET['offset']-1)*$params["limit"];
            }
        }

        $students=$this->model->getAllStudents($params);
        $this->view->response($students);
    }

    function showStudentById($params = null){
   
        $id = $params[':ID'];
        $students = $this->model->getStudentId($id);

        if ($students)
            $this->view->response($students);
        else 
            $this->view->response("El estudiante con el id $id no existe", 404);
    }

    public function addStudent($params = null) {
        
        //checkea si estas logueado antes de agregar estudiante
        if(!($this->authHelper->checkLoggedIn())){
            $this->view->response("Necesita estar logueado antes de agregar estudiante", 401);
            return;
        }
        $student = $this->getData();
        // si en el JSON falta algun dato saldra el error 400
        if (empty($student->nombre) || empty($student->edad) || empty($student->dni) || empty($student->carrera_id)) {
            $this->view->response("Complete los datos", 400);
        } 
        // sino se agrega.
        else {
            $id = $this->model->addStudents($student->nombre, $student->edad, $student->dni, $student->carrera_id);
            $student = $this->model->getStudentId($id);
            $this->view->response($student, 201);
        }
    }
    
}