<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Grupo extends RestController{
    public function __construct(){
        parent::__construct();
        $this->load->model('GrupoModel');
    }

    public function index_get($id=NULL){
        if ($id){
            $resultado = $this->GrupoModel->recuperarPorId($id);
        }else{
            $resultado = $this->GrupoModel->recuperarTodos();
        }
        $this->response($resultado, RestController::HTTP_OK);
    }

    public function index_post(){
        $grupo = $this->input->post("cliente");
			$this->GrupoModel->inserir($grupo);
			$msg = [
            "status" => true,
            "message" => 'Dados inseridos com sucesso!',
        ];
        $this->response($msg, RestController::HTTP_OK);
    }

    public function index_put($id){
        $grupo = $this->put("grupo");
          $this->GrupoModel->atualizar($id, $grupo);
          $msg = [
              "status" => true,
              "message" => 'Dados atualizados com sucesso!',
          ];
          $this->response($msg, RestController::HTTP_OK);
    }

    public function index_delete($id){
        $this->GrupoModel->excluir($id);
        $msg = [
        "status" => true,
        "message" => 'Dados excluídos com sucesso!',
    ];
    $this->response($msg, RestController::HTTP_OK);
    }
}
