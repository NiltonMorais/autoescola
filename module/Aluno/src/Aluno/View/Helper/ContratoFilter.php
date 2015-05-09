<?php
 
namespace Aluno\View\Helper;
 
use Zend\View\Helper\AbstractHelper;
use Aluno\Model\Contrato;
 
class ContratoFilter extends AbstractHelper
{
 
    protected $contrato;


    public function __invoke(Contrato $contrato)
    {
        $this->contrato = $contrato;
 
        return $this;
    }
 
    public function id()
    {
        $result = $this->contrato->id;
 
        return $this->view->escapeHtml($result);
    }
    
        public function aluno_id()
    {
        
        return $this->contrato->aluno_id;
    }
    
        public function valor()
    {
        $result = $this->contrato->valor;
 
        return $this->view->escapeHtml($result);
    }

 

    public function dataInicio()
    {
        $result = (new \DateTime($this->contrato->data_inicio))->format('d/m/Y');
 
        return $this->view->escapeHtml($result);
    }
    
    public function dataFim()
    {
        $result = (new \DateTime($this->contrato->data_fim))->format('d/m/Y');
 
        return $this->view->escapeHtml($result);
    }
    
    public function dataCadastro()
    {
        $result = (new \DateTime($this->contrato->data_cadastro))->format('d/m/Y - H:i');

        return $this->view->escapeHtml($result);
    }
 
    public function dataAlteracao()
    {
        $result = (new \DateTime($this->contrato->data_alteracao))->format('d/m/Y - H:i');

        return $this->view->escapeHtml($result);
    }
 
    public function quantMeses()
    {
        $result = $this->contrato->quant_meses;
 
        return $this->view->escapeHtml($result);
    }
    
}

