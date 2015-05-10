<?php
 
namespace Aluno\Controller;
use Zend\View\Model\ViewModel;
 
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
   
   public function indexAction()
    {
        $paramsUrl = [
            'pagina_atual'  => $this->params()->fromQuery('pagina', 1),
            'itens_pagina'  => $this->params()->fromQuery('itens_pagina', 10),
            'coluna_nome'   => $this->params()->fromQuery('coluna_nome', $this->colunaOrdem),
            'coluna_sort'   => $this->params()->fromQuery('coluna_sort', 'ASC'),
            'search'        => $this->params()->fromQuery('search', null),
        ];

        // configuar método de paginação
        $paginacao = $this->getServiceLocator()->get("ModelContrato")->fetchPaginator(
                /* $pagina */           $paramsUrl['pagina_atual'],
                /* $itensPagina */      $paramsUrl['itens_pagina'],
                /* $ordem */            "{$paramsUrl['coluna_nome']} {$paramsUrl['coluna_sort']}",
                /* $search */           $paramsUrl['search'],
                /* $itensPaginacao */   5
        );
                
        $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
        return new ViewModel(array('data' => $paginacao,'alunos' => $alunos) + $paramsUrl);
    }
   
    public function novoAction()
    {                         
        $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
        return ['form' => new $this->form(null, $alunos)];
    }
 
     public function detalhesAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Cadastro não encotrado");

               // redirecionar para action index
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = $this->getServiceLocator()->get("ModelContrato")->find($id);
                $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute($this->route);   
            }
            
           
           // dados eviados para detalhes.phtml
           return array('id' => $id, 'data' => $data, 'alunos' => $alunos);
    }
   
}