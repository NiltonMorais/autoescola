<?php

namespace Aluno\Model;

use Zend\Db\TableGateway\TableGateway;
use \Exception;

// import for fetchPaginator
use Zend\Db\Sql\Select,
    Zend\Db\ResultSet\HydratingResultSet,
    Zend\Stdlib\Hydrator\Reflection,
    Zend\Paginator\Adapter\DbSelect,
    Zend\Paginator\Paginator;

class AlunoTable {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {       
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(){
        return $this->tableGateway->select();
    }
    
    public function fetchPairs(){
        
        $todos = $this->fetchAll();
        
        $array = array();
         
        foreach($todos as $aluno){
            $array[$aluno->id] = $aluno->nome;
        }
        return $array;
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
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'),
            'cpf'                   => $aluno->cpf,
            'end_rua'               => $aluno->end_rua,
            'end_bairro'            => $aluno->end_bairro,
            'end_cidade'            => $aluno->end_cidade,
            'end_estado'            => $aluno->end_estado,
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
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'), 
            'cpf'                   => $aluno->cpf,
            'end_rua'               => $aluno->end_rua,
            'end_bairro'            => $aluno->end_bairro,
            'end_cidade'            => $aluno->end_cidade,
            'end_estado'            => $aluno->end_estado,
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
    
    
    

    /**
     * Localizar itens por paginação
     * 
     * @param type $pagina
     * @param type $itensPagina
     * @param type $ordem
     * @param type $like
     * @param type $itensPaginacao
     * @return type Paginator
     */
    public function fetchPaginator($pagina = 1, $itensPagina = 10, $ordem = 'nome ASC', $like = null, $itensPaginacao = 5) 
    {

        $select = (new Select('alunos'))->order($ordem);

        if (isset($like)) {
            $select
                    ->where
                    ->like('id', "%{$like}%")
                    ->or
                    ->like('nome', "%{$like}%")
            ;
        }


        $resultSet = new HydratingResultSet(new Reflection(), new Aluno());


        $paginatorAdapter = new DbSelect(
            $select,
            $this->tableGateway->getAdapter(),
            $resultSet
        );

        return (new Paginator($paginatorAdapter))
                // pagina a ser buscada
                ->setCurrentPageNumber((int) $pagina)
                // quantidade de itens na página
                ->setItemCountPerPage((int) $itensPagina)
                ->setPageRange((int) $itensPaginacao);
    }


}
