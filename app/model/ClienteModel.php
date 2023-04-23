<?php 

namespace app\model;

final class ClienteModel extends Model
{
    protected $table_name  =  'clientes';
    protected $primary_key =  'id';
    protected $return_type =  'object'; // object | array | ClassExample::class

    public function toggleStatusCliente($idCliente){
        $cliente = $this->find($idCliente);

        $data = [
            'id' => $cliente->id,
            'cliente_ativo' =>  $cliente->cliente_ativo ? 0 : 1
        ];

        return $this->update($data);
    
    }
}