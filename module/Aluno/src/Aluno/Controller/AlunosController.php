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
       $this->colunaOrdem = "data_cadastro";
   }
   
        public function detalhesAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Aluno não encotrado");

               // redirecionar para action index
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = $this->getServiceLocator()->get("ModelAluno")->find($id);
                $contrato = $this->getServiceLocator()->get("ModelContrato")->findAluno($id);
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute($this->route);   
            }
            
           
           // dados eviados para detalhes.phtml
           return array('id' => $id, 'data' => $data, 'contrato' => $contrato);
    }
    
    public function deletarAction()
    {
            $id = (int) $this->params()->fromRoute('id', 0);       

            if (!$id) {
                $this->flashMessenger()->addMessage("Aluno não encontrado");

            } 
            else 
                {
                    $aluno = $this->getServiceLocator()->get("ModelContrato")->findAluno($id);
                    if($aluno)
                       {
                            $this->flashMessenger()->addMessage("Existe um contrato cadastrado para este aluno. Exclua-o primeiro");
                       }
                       else{
                           $this->getServiceLocator()->get("ModelAluno")->delete($id);
                           $this->flashMessenger()->addSuccessMessage("Aluno de ID $id deletado com sucesso");
                       }
                   
                }

            return $this->redirect()->toRoute($this->route);
    }
}