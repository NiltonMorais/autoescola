<?php

namespace Aluno\Model;

use Zend\Db\TableGateway\TableGateway;

class AlunoTable {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {       
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(){
        return $this->tableGateway->select();
    }
    
    public function find($id){
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
             throw new Exception("Não foi encontrado aluno de id = {$id}");
        }
        return $row;
    }
}
