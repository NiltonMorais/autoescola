<?php
 
namespace Aluno\Controller;
 
class AlunosController extends CrudController
{
     public function __construct() {
       $this->serviceTable = "ModelAluno";
       $this->form = "Aluno\Form\Aluno";
       $this->model = "Aluno\Model\Aluno";
       $this->route = "alunos";
       $this->caminhoViews = "aluno/alunos/";
   }
}