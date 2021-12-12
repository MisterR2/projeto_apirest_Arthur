<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Cliente extends RestController{
    public function __construct(){
        parent::__construct();
        $this->load->model('ClienteModel');
    }

    public function index_get($id=NULL){
        if ($id){
            $resultado = $this->ClienteModel->recuperarPorId($id);
        }else{
            $resultado = $this->ClienteModel->recuperarTodos();
        }
        $this->response($resultado, RestController::HTTP_OK);
    }

    public function index_post(){
        $cliente = $this->input->post("cliente");
			$this->ClienteModel->inserir($cliente);
			$msg = [
            "status" => true,
            "message" => 'Dados inseridos com sucesso!',
        ];
        $this->response($msg, RestController::HTTP_OK);
    }

    public function index_put($id){
        $cliente = $this->put("cliente");
          $this->ClienteModel->atualizar($id, $cliente);
          $msg = [
              "status" => true,
              "message" => 'Dados atualizados com sucesso!',
          ];
          $this->response($msg, RestController::HTTP_OK);
    }

    public function index_delete($id){
        $this->ClienteModel->excluir($id);
        $msg = [
        "status" => true,
        "message" => 'Dados excluídos com sucesso!',
    ];
    $this->response($msg, RestController::HTTP_OK);
    }
}
