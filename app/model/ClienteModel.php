<?php 

namespace app\model;

final class ClienteModel extends Model
{
    protected $table_name  =  'clientes';
    protected $primary_key =  'id';
    protected $return_type =  'object'; // object | array | ClassExample::class
}