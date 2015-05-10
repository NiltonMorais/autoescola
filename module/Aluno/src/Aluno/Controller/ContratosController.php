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
    
    
    
        public function adicionarAction()
    {
         $request = $this->getRequest();
 
        if ($request->isPost()) {
            $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
            $form = new $this->form(null, $alunos);
            $form->setData($request->getPost());
            $model = new $this->model();
        if ($form->isValid()) {
            
            $model->exchangeArray($form->getData());
            $this->getServiceLocator()->get("ModelContrato")->save($model);
            
            $this->flashMessenger()->addSuccessMessage("Cadastro criado com sucesso");
            return $this->redirect()->toRoute($this->route);
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao criar cadastro");
           return (new ViewModel())
                            ->setVariable('form', $form)
                            ->setTemplate($this->caminhoViews.'novo');
        }
    }
    }
    
      
    public function editarAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Cadastro não encotrado");
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = (array)$this->getServiceLocator()->get("ModelContrato")->find($id);
            } catch (Exception $exc) {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                 return $this->redirect()->toRoute($this->route);   
            }
            
            $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
            $form = new $this->form(null, $alunos);
            $form->setData($data);

           return ['form' => $form];
    }
 
    
    public function atualizarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
            $form = new $this->form(null, $alunos);
            $model = new $this->model();
            
            $form->setData($request->getPost());
 
       
        if ($form->isValid()) {
            $model->exchangeArray($form->getData());
            $this->getServiceLocator()->get("ModelContrato")->update($model);
            
            $this->flashMessenger()->addSuccessMessage("Cadastro editado com sucesso");

            return $this->redirect()->toRoute($this->route, array("action" => "detalhes", "id" => $model->id));
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao editar cadastro");
 
           return (new ViewModel())
                            ->setVariable('form', $form)
                            ->setTemplate($this->caminhoViews.'editar');
        }
    }
    }
 
   
}