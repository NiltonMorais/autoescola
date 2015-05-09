<?php
 
namespace Aluno\Controller;
 
class ContratosController extends CrudController
{
     public function __construct() {
       $this->serviceTable = "ModelContrato";
       $this->form = "Aluno\Form\Contrato";
       $this->model = "Aluno\Model\Contrato";
       $this->route = "contratos";
       $this->caminhoViews = "aluno/contratos/";
       $this->colunaOrdem = "id";
   }
   
    public function novoAction()
    {                         
        $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
        return ['form' => new $this->form(null, $alunos)];
    }
 
   
}