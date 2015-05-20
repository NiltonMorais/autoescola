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

class ContratoTable {
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
             throw new Exception("Não foi encontrado contrato de id = {$id}");
        }
        return $row;
    }
    
    public function findAluno($aluno_id){
        $aluno_id = (int)$aluno_id;
        $rowset = $this->tableGateway->select(array('aluno_id' => $aluno_id));
        $row = $rowset->current();
        return $row;
    }
    
     public function save(Contrato $contrato)
    {
        $timeNow = new \DateTime();
        $dataInicio = new \DateTime($contrato->data_inicio);
        $dataFim = new \DateTime($contrato->data_fim);   
        
        $intervalo = $dataInicio->diff( $dataFim );
 
        $data = [
            'valor'                 => $contrato->valor,
            'data_inicio'           => $contrato->data_inicio,
            'data_fim'              => $contrato->data_fim,
            'data_cadastro'         => $timeNow->format('Y-m-d H:i:s'),
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'),
            'quant_meses'           => $intervalo->m,
            'aluno_id'              => $contrato->aluno_id,
            'valor_aula_carro'      => $contrato->valor_aula_carro,
            'valor_aula_moto'       => $contrato->valor_aula_moto,
            'valor_aula_teorica'    => $contrato->valor_aula_teorica,
        ];
 
        return $this->tableGateway->insert($data);
    }
    
     public function update(Contrato $contrato)
    {
        $timeNow = new \DateTime();
        $dataInicio = new \DateTime($contrato->data_inicio);
        $dataFim = new \DateTime($contrato->data_fim);   
        
        $intervalo = $dataInicio->diff( $dataFim );
 
        $data = [
            'valor'                 => $contrato->valor,
            'data_inicio'           => $contrato->data_inicio,
            'data_fim'              => $contrato->data_fim,
            'data_alteracao'        => $timeNow->format('Y-m-d H:i:s'),
            'quant_meses'           => $intervalo->m,
            'aluno_id'              => $contrato->aluno_id,
            'valor_aula_carro'      => $contrato->valor_aula_carro,
            'valor_aula_moto'       => $contrato->valor_aula_moto,
            'valor_aula_teorica'    => $contrato->valor_aula_teorica,
        ];
 
        $id = (int) $contrato->id;
        if ($this->find($id)) {
            $this->tableGateway->update($data, array('id' => $id));
        } else {
            throw new Exception("Contrato #{$id} inexistente");
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
    public function fetchPaginator($pagina = 1, $itensPagina = 10, $ordem = 'id ASC', $like = null, $itensPaginacao = 5) 
    {

        $select = (new Select('contratos'))->order($ordem);

        if (isset($like)) {
            $select
                    ->where
                    ->like('id', "%{$like}%")
            ;
        }


        $resultSet = new HydratingResultSet(new Reflection(), new Contrato());


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
