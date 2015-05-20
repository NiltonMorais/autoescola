<?php
 
namespace Aluno\Controller;
use Zend\View\Model\ViewModel;
use DOMPDFModule\View\Model\PdfModel;
 
class ContratosController extends CrudController
{
     public function __construct() {
       $this->serviceTable = "ModelContrato";
       $this->form = "Aluno\Form\Contrato";
       $this->model = "Aluno\Model\Contrato";
       $this->route = "contratos";
       $this->caminhoViews = "aluno/contratos/";
       $this->colunaOrdem = "data_cadastro";
   }
   
   
   public function indexAction()
    {
        $paramsUrl = [
            'pagina_atual'  => $this->params()->fromQuery('pagina', 1),
            'itens_pagina'  => $this->params()->fromQuery('itens_pagina', 10),
            'coluna_nome'   => $this->params()->fromQuery('coluna_nome', $this->colunaOrdem),
            'coluna_sort'   => $this->params()->fromQuery('coluna_sort', 'DESC'),
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
        $id_aluno = (int) $this->params()->fromRoute('id');
        
        $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchPairs();
        return ['form' => new $this->form(null, $alunos, $id_aluno)];
    }
 
    
     public function detalhesAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Contrato não encontrado");

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
    
    public function visualizarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Contrato não encontrado");

               // redirecionar para action index
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = $this->getServiceLocator()->get("ModelContrato")->find($id);
                $aluno = $this->getServiceLocator()->get("ModelAluno")->find($data->aluno_id);
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute($this->route);   
            }
            
           $pdf = new PdfModel();
           $pdf->setVariables(array('id' => $id, 'data' => $data, 'aluno' => $aluno));
           
           return $pdf;
              
    }

    
    
    public function salvarpdfAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Contrato não encontrado");

               // redirecionar para action index
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = $this->getServiceLocator()->get("ModelContrato")->find($id);
                $aluno = $this->getServiceLocator()->get("ModelAluno")->find($data->aluno_id);
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute($this->route);   
            }
            
           $pdf = new PdfModel();
           $pdf->setVariables(array('id' => $id, 'data' => $data, 'aluno' => $aluno))
                   ->setOption('filename', 'Contrato-nº'.$data->id.'-'.$aluno->nome);
           return $pdf;
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
            
            $aluno_id = $request->getPost('aluno_id');
            $contrato = $this->getServiceLocator()->get("ModelContrato")->findAluno($aluno_id);
            
            if(!empty($contrato))
            {
                $this->flashMessenger()->addErrorMessage("Já existe um contrato cadastrado para este o aluno");
                return (new ViewModel())
                            ->setVariable('form', $form)
                            ->setTemplate($this->caminhoViews.'novo');
            }
            else
            {
                $model->exchangeArray($form->getData());
                $this->getServiceLocator()->get("ModelContrato")->save($model);

                $this->flashMessenger()->addSuccessMessage("Contrato criado com sucesso");
                return $this->redirect()->toRoute($this->route);
            }
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao criar contrato");
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
               $this->flashMessenger()->addMessage("Contrato não encontrado");
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
            
            $this->flashMessenger()->addSuccessMessage("Contrato editado com sucesso");

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