<?php 

namespace app\controller;

use app\model\Database;
use app\model\ClienteModel;
use app\model\Filters;
use app\model\Pagination;

class Main extends BaseController
{
    public function index()
    {
        $this->view([
            'cadastroCliente'
        ]);
    }

    public function cadastrarCliente()
    {
        $data = [
            'nome'  => filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST,'email',FILTER_SANITIZE_SPECIAL_CHARS),
            'cliente_ativo' => 1
        ];

        try {
            
            $clienteModel = new ClienteModel(Database::getInstance());
    
            $inserir = $clienteModel->insert($data);

            if($inserir == 0){
                throw new \Exception('Ocorreu um erro ao inseir o cliente!');
            }

            $resposta = [
                'status'  => 'success',
                'message' => 'Cliente cadastrado com sucesso',
                'data'    => $clienteModel->find($clienteModel->last_primary_key())
            ];
    

        } catch (\Exception $e) {

            $resposta = [
                'status'  => 'error',
                'message' => 'Ocorreu um erro ao inseir o cliente!',
                'data'    => []
            ];
    
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resposta,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

    public function alterarStatusCliente()
    {
        $idCliente = filter_input(INPUT_GET,'idCliente',FILTER_SANITIZE_NUMBER_INT);

        try {

            $clienteModel = new ClienteModel(Database::getInstance());
            $clienteStatus = $clienteModel->toggleStatusCliente($idCliente);

            if($clienteStatus < 1)
            {
                throw new \Exception('Ocorreu um erro ao atualizar o status do cliente!');
            }

            $resposta = [
                'status' => 'success',
                'message' => 'Status do cliente atualizado com sucesso!'
            ];
            
        } catch (\Exception $e) {

            $resposta = [
                'status' => 'error',
                'message' => 'Ocorreu um erro ao atualizar o status do cliente!'
            ];
        }


        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resposta,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

    }

    public function buscarCliente()
    {   
        $conn = Database::getInstance();

        $clienteModel = new ClienteModel($conn);
        $umCliente = $clienteModel->find(1);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($umCliente,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }

    public function buscarTodosClientes()
    {
        $conn = Database::getInstance();

        $clienteModel = new ClienteModel($conn);

        $filters = new Filters;
        $filters->orderBy('id','DESC');

        $clienteModel->setFilters($filters);
        $clienteModel->setPagination(new Pagination());
        $todosClientes = $clienteModel->findAll();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($todosClientes,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}