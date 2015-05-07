<?php
 
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class CrudController extends AbstractActionController
{
    protected $tableGateway;
    protected $serviceTable;
    protected $form;
    protected $model;
    protected $route;
    protected $caminhoViews;
    
    
    public function indexAction()
    {
        return new ViewModel(array('data' => $this->getServiceTable()->fetchAll()));
    }
 
 
    
    public function novoAction()
    {
        return ['form' => new $this->form()];
    }
 
    
    
    public function adicionarAction()
    {
         $request = $this->getRequest();
 
        if ($request->isPost()) {
            $form = new $this->form();
            $form->setData($request->getPost());
            $model = new $this->model();
        if ($form->isValid()) {
            
            $model->exchangeArray($form->getData());
            $this->getServiceTable()->save($model);
            
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
 
    
    
    public function detalhesAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Cadastro não encotrado");

               // redirecionar para action index
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = $this->getServiceTable()->find($id);
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute($this->route);   
            }
            
           // dados eviados para detalhes.phtml
           return array('id' => $id, 'data' => $data);
    }
 
    
    
    public function editarAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Cadastro não encotrado");
               return $this->redirect()->toRoute($this->route);
           }

            try{
                $data = (array)$this->getServiceTable()->find($id);
            } catch (Exception $exc) {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                 return $this->redirect()->toRoute($this->route);   
            }
            
            $form = new $this->form();
            $form->setData($data);

           return ['form' => $form];
    }
 
    
    public function atualizarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new $this->form();
            $model = new $this->model();
            
            $form->setData($request->getPost());
 
       
        if ($form->isValid()) {
            $model->exchangeArray($form->getData());
            $this->getServiceTable()->update($model);
            
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
 
    
    public function deletarAction()
    {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (!$id) {
                $this->flashMessenger()->addMessage("Cadastro não encotrado");

            } else {
                $this->getServiceTable()->delete($id);
                $this->flashMessenger()->addSuccessMessage("Cadastro de ID $id deletado com sucesso");
            }

            return $this->redirect()->toRoute($this->route);
    }
    
    
    private function getServiceTable()
    {
        if (!$this->tableGateway) {
            $this->tableGateway = $this->getServiceLocator()->get($this->serviceTable);
        }
 
        return $this->tableGateway;
    }
}