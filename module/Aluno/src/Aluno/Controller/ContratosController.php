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
   }
   
}