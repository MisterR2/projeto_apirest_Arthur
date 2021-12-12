<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Produto extends RestController{
    public function __construct(){
        parent::__construct();
        $this->load->model('ProdutoModel');
        // $this->load->model('GrupoModel');
        // $this->load->model('FornecedorModel');
        // $this->load->model('FabricanteModel');
    }

    public function index_get($id=NULL){
        if ($id==NULL){
            $resultado = $this->ProdutoModel->recuperarTodos();
            return $this->response($resultado, RestController::HTTP_OK);
        }else{
            $resultado = $this->ProdutoModel->recuperarPorId($id);
            if (count($resultado)==0){
                $resultado["status"]=404;
                $resultado["message"]="Id inválido";
                return $this->response($resultado, RestController::HTTP_NOT_FOUND);
            }else{
                return $this->response($resultado, RestController::HTTP_OK);
            }
        }  
    }

    public function index_post(){
        $produto = $this->input->post("produto");
        $preco = $this->input->post("preco");
        $qtd = $this->input->post("qtd");
        $codfabricante = $this->input->post("codfabricante");
        $codgrupo = $this->input->post("codgrupo");

        $this->ProdutoModel->inserir($produto, $preco, $qtd, $codfabricante, $codgrupo);
        $resultado["status"]=true;
        $resultado["mensagem"]="Dados inseridos com sucesso!";
        $this->response($resultado, RestController::HTTP_OK);
    }

    public function index_put($id){
        $produto = $this->put("produto");
        $preco = $this->put("preco");
        $qtd = $this->put("qtd");
        $codfabricante = $this->put("codfabricante");
        $codgrupo = $this->put("codgrupo");

        $this->ProdutoModel->atualizar($id, $produto, $preco, $qtd, $codfabricante, $codgrupo);
        $resultado["status"]=true;
        $resultado["mensagem"]="Dados atualizados com sucesso!";
        $this->response($resultado, RestController::HTTP_OK);
    }

    public function index_delete($id){

    }

    
    //Código para incluir na função index_get para recuperar o objeto grupo e o objeto fabricante ao invés apenas do código
    /*foreach ($resultado as $r){
        $r->grupo = $this->GrupoModel->recuperarPorId($r->codgrupo);
        $r->fabricante = $this->FabricanteModel->recuperarPorId($r->codfabricante);
        unset($r->codgrupo);
        unset($r->codfabricante);
    }*/
    
}
