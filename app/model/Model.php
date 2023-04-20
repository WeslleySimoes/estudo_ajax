<?php

namespace app\model;

abstract class Model
{
    //PROPRIEDADES
    protected $table_name  = '';
    protected $primary_key = '';
    protected $return_type = '';  //array OR object OR ClassExemple::class -> retorna o nome completo da classe
    protected $filters     = '';
    protected $pagination  = '';
    protected \PDO $db;

    //MÉTODO CONSTRUTOR
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    //DEFINE A PAGINAÇÃO DE UMA CONSULTA DE MULTIPLOS REGISTROS
    public function setPagination(Pagination $pagination)
    {
        $pagination->setTotalItems($this->count());
        $this->pagination = $pagination->dump();
    }

    //DEFINE FILTROS DE PESQUISA USANDO A CLASSE 'FILTERS'
    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
    }

    // RETORNA O TIPO DE DADO A SER RETORNADO DE UMA QUERY(CONSULTA)
    protected function return_type($query,$fetch_type = 'fetchAll')
    {
        if($this->return_type == 'array') {
            return $this->fetch_assoc($query,$fetch_type);
        } elseif($this->return_type == 'object') {
            return $this->fetch_obj($query,$fetch_type);
        } elseif(class_exists($this->return_type)) {
            return $this->fetch_class($query,$fetch_type);
        } else {
            throw new \Exception('Return type invalid!');
        }
    }

    // Retorna objeto(s) da clase \stdClass
    protected function fetch_obj($query,$fetch_type='fetchAll')
    {
        if($fetch_type == 'fetch')
        {
            return $query->fetch(\PDO::FETCH_OBJ);
        }else{
            return $query->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    // Retorna objeto(s) da classe especificada: ClassExample::class
    protected function fetch_class($query,$fetch_type='fetchAll')
    {
        if($fetch_type == 'fetch')
        {
            return $query->fetch(\PDO::FETCH_CLASS,$this->return_type);
        }else{
            return $query->fetchAll(\PDO::FETCH_CLASS,$this->return_type);
        }
    }

    // Retorna array(s) associativo(s)
    protected function fetch_assoc($query,$fetch_type='fetchAll')
    {
        if($fetch_type == 'fetch')
        {
            return $query->fetch(\PDO::FETCH_ASSOC);
        }else{
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    // CONTA A QUANTIDADE DE REGISTROS
    public function count()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table_name} {$this->filters}";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $this->fetch_obj($query,'fetch');

        return !$result ? null : $result->total;
    }

    // BUSCA UM REGISTRO ATRAVÉS DA CHAVE PRIMARIA
    public function find($id)
    {   
        $sql = "SELECT * FROM {$this->table_name} WHERE {$this->primary_key} = :id";

        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        $result = $this->return_type($query,'fetch');

        return !$result ? null : $result;
    }           

    // BUSCA TODOS OS REGISTROS 
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table_name} {$this->filters} {$this->pagination}";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $this->return_type($query,'fetchAll');

        return !$result ? null : $result;
    }

    // INSERI UM REGISTRO NO BANCO DE DADOS
    public function insert(array $data)
    {
        if(isset($data[$this->primary_key]))
        {
            throw new \Exception('Não deve haver primary key para inserção de dados!');
        }

        $columns = implode(',',array_keys($data));
        $values  =  ':'.implode(',:',array_keys($data));

        $sql = "INSERT INTO {$this->table_name} ({$columns}) VALUES ({$values})";

        $insert = $this->db->prepare($sql);
        $insert->execute($data);

        $result = $insert->rowCount();

        return $result;
        
    }

    // ATUALIZA UM REGISTRO NO BANCO DE DADOS ATRAVÉS DA CHAVE PRIMÁRIA
    public function update(array $data)
    {
        if(isset($data[$this->primary_key]))
        {
            $set_columns  =  '';
    
            foreach($data as $key => $value)
            {
                if($key == $this->primary_key) continue;
            
                $set_columns .= "{$key} = :{$key}, ";
            }
    
            $set_columns = rtrim($set_columns,', ');
    
            $sql = "UPDATE {$this->table_name} SET {$set_columns} WHERE {$this->primary_key} = :{$this->primary_key}";

            $insert = $this->db->prepare($sql);
            $insert->execute($data);
    
            $result = $insert->rowCount();
    
            return $result;
        }

        throw new \Exception('Chave primaria não definida!');
    }

    // DELETA UM REGISTRO ATRAVÉS DA CHAVE PRIMÁRIA
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE {$this->primary_key} = :id";

        $insert = $this->db->prepare($sql);
        $insert->execute([
            ':id' => $id
        ]);

        $result = $insert->rowCount();

        return $result;
    }

    // RETORNA O VALOR DA ÚLTIMA CHAVE PRIMÁRIA INSERIDA
    public function last_primary_key()
    {
        $sql = "SELECT MAX(idUsuario) AS last_pk FROM {$this->table_name}";

        $query = $this->db->prepare($sql);
        $query->execute();

        $result = $query->fetchObject();

        return !$result ? null : $result->last_pk;
    }
}