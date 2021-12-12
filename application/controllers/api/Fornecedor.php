<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Fornecedor extends RestController{
    public function __construct(){
        parent::__construct();
        $this->load->model('FornecedorModel');
    }

    public function index_get($id=NULL){
        if ($id){
            $resultado = $this->FornecedorModel->recuperarPorId($id);
        }else{
            $resultado = $this->FornecedorModel->recuperarTodos();
        }
        $this->response($resultado, RestController::HTTP_OK);
    }

    public function index_post(){
        $fornecedor = $this->input->post("fornecedor");
			$this->FornecedorModel->inserir($fornecedor);
			$msg = [
            "status" => true,
            "message" => 'Dados inseridos com sucesso!',
        ];
        $this->response($msg, RestController::HTTP_OK);
    }

    public function index_put($id){
        $fornecedor = $this->put("fornecedor");
          $this->FornecedorModel->atualizar($id, $fornecedor);
          $msg = [
              "status" => true,
              "message" => 'Dados atualizados com sucesso!',
          ];
          $this->response($msg, RestController::HTTP_OK);
    }

    public function index_delete($id){
        $this->FornecedorModel->excluir($id);
        $msg = [
        "status" => true,
        "message" => 'Dados excluídos com sucesso!',
    ];
    $this->response($msg, RestController::HTTP_OK);
    }
}
