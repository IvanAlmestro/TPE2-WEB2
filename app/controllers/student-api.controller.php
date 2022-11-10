<?php
require_once './app/models/student.model.php';
require_once './app/views/api.view.php';

class TaskApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new StudentModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }
    
    private function getData() {
        return json_decode($this->data);
    }

    public function getTasks($params = null) {
        $tasks = $this->model->getAll();
        $this->view->response($tasks);
    }

    public function getTask($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $task = $this->model->get($id);

        // si no existe devuelvo 404
        if ($task)
            $this->view->response($task);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deleteTask($params = null) {
        $id = $params[':ID'];

        $task = $this->model->get($id);
        if ($task) {
            $this->model->delete($id);
            $this->view->response($task);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertTask($params = null) {
        $task = $this->getData();

        if (empty($task->titulo) || empty($task->descripcion) || empty($task->prioridad)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($task->titulo, $task->descripcion, $task->prioridad);
            $task = $this->model->get($id);
            $this->view->response($task, 201);
        }
    }

}