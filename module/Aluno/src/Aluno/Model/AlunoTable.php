<?php

namespace Aluno\Model;

use Zend\Db\TableGateway\TableGateway;
use \Exception;

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
    
     public function save(Aluno $aluno)
    {
        $timeNow = new \DateTime();
 
        $data = [
            'nome'                  => $aluno->nome,
            'email'                 => $aluno->email,
            'sexo'                  => $aluno->sexo,
            'telefone'              => $aluno->telefone,
            'telefone2'             => $aluno->telefone2,
            'data_nascimento'       => $aluno->data_nascimento,
            'data_cadastro'         => $timeNow->format('Y-m-d H:i:s'), 
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'), # data de criação igual a de atualização 
        ];
 
        return $this->tableGateway->insert($data);
    }
    
     public function update(Aluno $aluno)
    {
        $timeNow = new \DateTime();
 
        $data = [
            'nome'                  => $aluno->nome,
            'email'                 => $aluno->email,
            'sexo'                  => $aluno->sexo,
            'telefone'              => $aluno->telefone,
            'telefone2'             => $aluno->telefone2,
            'data_nascimento'       => $aluno->data_nascimento,
            'data_cadastro'         => $timeNow->format('Y-m-d H:i:s'), 
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'), # data de criação igual a de atualização 
        ];
 
        $id = (int) $aluno->id;
        if ($this->find($id)) {
            $this->tableGateway->update($data, array('id' => $id));
        } else {
            throw new Exception("Aluno #{$id} inexistente");
        }
    }
    
    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
