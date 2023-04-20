<?php 

namespace app\controller;

use app\model\Database;
use app\model\ClienteModel;

class Main extends BaseController
{
    public function index()
    {
        $this->view([
            'exemplo2'
        ]);
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
        $todosClientes = $clienteModel->findAll();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($todosClientes,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}