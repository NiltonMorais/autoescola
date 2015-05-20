<?php
 
namespace Aluno\View\Helper;
 
use Zend\View\Helper\AbstractHelper;
use Aluno\Model\Aluno;
 
class AlunoFilter extends AbstractHelper
{
 
    protected $aluno;   
 
    public function __invoke(Aluno $aluno)
    {
        $this->aluno = $aluno;
 
        return $this;
    }
 
    public function id()
    {
        $result = $this->aluno->id;
 
        return $this->view->escapeHtml($result);
    }
 
    public function nomeSobrenome()
    {
        $partes_nome = explode(" ", $this->nomeCompleto());
        $result = null;
 
        if (count($partes_nome) <= 2) {
            $result = join($partes_nome, " ");
        } else {
            $result = "{$partes_nome[0]} {$partes_nome[1]} ...";
        }
 
        return $this->view->escapeHtml($result);
    }
 
    public function nomeCompleto()
    {
        $result = ucwords(mb_strtolower($this->aluno->nome, "UTF-8"));
 
        return $this->view->escapeHtml($result);
    }
    
    public function enderecoCompleto()
    {
        $result = $this->aluno->end_rua.", ".$this->aluno->end_bairro.", ".$this->aluno->end_cidade."-".$this->aluno->end_estado;
        return $this->view->escapeHtml($result);
    }
 
    public function quantidadeTelefones()
    {
        $result = ((int) !empty($this->aluno->telefone)) + ((int) !empty($this->aluno->telefone2));
 
        return $this->view->escapeHtml($result);
    }
 
    public function dataCadastro()
    {
        $result = (new \DateTime($this->aluno->data_cadastro))->format('d/m/Y - H:i');
 
        return $this->view->escapeHtml($result);
    }
 
    public function dataAlteracao()
    {
        $result = (new \DateTime($this->aluno->data_alteracao))->format('d/m/Y - H:i');

        return $this->view->escapeHtml($result);
    }
 
    public function telefone()
    {
        $result = $this->aluno->telefone ? $this->aluno->telefone : 'Sem Registro';
 
        return $this->view->escapeHtml($result);
    }
 
    public function telefone2()
    {
        $result = $this->aluno->telefone2 ? $this->aluno->telefone2 : 'Sem Registro';
 
        return $this->view->escapeHtml($result);
    }
    
    public function email()
    {
        $result = $this->aluno->email;
        return $this->view->escapeHtml($result);
    }
    
    public function sexo()
    {
        if($this->aluno->sexo == "m")
        {
            $result = "Masculino";
        }
        else if($this->aluno->sexo == "f")
        {
            $result = "Feminino";
        }
        else {
            $result = $this->aluno->sexo;
        }
        return $this->view->escapeHtml($result);
    }
    
    
     public function idade()
    {
        $dataAtual = new \DateTime();
        $dataNascimento = new \DateTime($this->aluno->data_nascimento);
        $idade = $dataAtual->format('Y') - $dataNascimento->format('Y');
        
        $mesAtual = $dataAtual->format('m');
        $mesNasceu = $dataNascimento->format('m');
        
        if($mesAtual<$mesNasceu)
        {
            $idade -= 1;
        }

        return $this->view->escapeHtml($idade)." Anos";
    }
    
    public function dataNascimento()
    {
        $result = (new \DateTime($this->aluno->data_nascimento))->format('d/m/Y');

        return $this->view->escapeHtml($result);
    }
    
    public function verificaContrato($contrato)
    {
        if(isset($contrato->id))
        {
            return true;
        }
        else{
             return false;
        }
    }
 
}