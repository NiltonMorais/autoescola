<?php
 
namespace Aluno\View\Helper;
 
use Zend\View\Helper\AbstractHelper;
use Aluno\Model\Contrato;
 
class ContratoFilter extends AbstractHelper
{
 
    protected $contrato;
    protected $alunos;


    public function __invoke(Contrato $contrato, array $alunos = null)
    {
        $this->contrato = $contrato;
        $this->alunos = $alunos;
 
        return $this;
    }
 
    public function id()
    {
        $result = $this->contrato->id;
 
        return $this->view->escapeHtml($result);
    }
    
     public function aluno_id()
    {        
        $result = $this->contrato->aluno_id;
        return $this->view->escapeHtml($result);
    }
    
    public function aluno()
    {
        $partes_nome = explode(" ", ucwords(mb_strtolower($this->alunos[$this->contrato->aluno_id], "UTF-8")));
        
        if (count($partes_nome) <= 2) {
            $result = join($partes_nome, " ");
        } else {
            $result = "{$partes_nome[0]} {$partes_nome[1]} ...";
        }
        
        #$result = $this->alunos[$this->contrato->aluno_id];
        return $this->view->escapeHtml($result);
    }
    
    public function alunoCompleto()
    {
        $result = ucwords(mb_strtolower($this->alunos[$this->contrato->aluno_id], "UTF-8"));
 
        return $this->view->escapeHtml($result);
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

