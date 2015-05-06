<?php
 
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Aluno\Form\Aluno as AlunoForm;
use Aluno\Model\Aluno as AlunoM;
 
class AlunosController extends AbstractActionController
{
    protected $alunoTable;
    
    public function indexAction()
    {
        return new ViewModel(array('alunos' => $this->getAlunoTable()->fetchAll()));
    }
 
 
    
    public function novoAction()
    {
        return ['formAluno' => new AlunoForm()];
    }
 
    
    
    public function adicionarAction()
    {
         $request = $this->getRequest();
 
        if ($request->isPost()) {
            $form = new AlunoForm();
            $form->setData($request->getPost());
            $modelAluno = new AlunoM();
        if ($form->isValid()) {
            
            $modelAluno->exchangeArray($form->getData());
            $this->getAlunoTable()->save($modelAluno);
            
            $this->flashMessenger()->addSuccessMessage("Aluno criado com sucesso");
            return $this->redirect()->toRoute('alunos');
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao criar contato");
           return (new ViewModel())
                            ->setVariable('formAluno', $form)
                            ->setTemplate('aluno/alunos/novo');
        }
    }
    }
 
    
    
    public function detalhesAction()
    {
            // filtra id passsado pela url
           $id = (int) $this->params()->fromRoute('id', 0);

           // se id = 0 ou não informado redirecione para alunos
           if (!$id) {
               // adicionar mensagem
               $this->flashMessenger()->addMessage("Aluno não encotrado");

               // redirecionar para action index
               return $this->redirect()->toRoute('alunos');
           }

            try{
                $aluno = $this->getAlunoTable()->find($id);
            } catch (Exception $exc) {
                  // adicionar mensagem
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                // redirecionar para action index
                 return $this->redirect()->toRoute('alunos');   
            }
            
           // dados eviados para detalhes.phtml
           return array('id' => $id, 'aluno' => $aluno);
    }
 
    
    
    public function editarAction()
    {
           $id = (int) $this->params()->fromRoute('id', 0);

           if (!$id) {
               $this->flashMessenger()->addMessage("Aluno não encotrado");
               return $this->redirect()->toRoute('alunos');
           }

            try{
                $aluno = (array)$this->getAlunoTable()->find($id);
            } catch (Exception $exc) {
                $this->flashMessenger()->addErrorMessage($exc->getMessage());
                 return $this->redirect()->toRoute('alunos');   
            }
            
            $form = new AlunoForm();
            $form->setData($aluno);

           return ['form' => $form];
    }
 
    
    public function atualizarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new AlunoForm();
            $modelAluno = new AlunoM();
            
            $form->setData($request->getPost());
 
       
        if ($form->isValid()) {
            $modelAluno->exchangeArray($form->getData());
            $this->getAlunoTable()->update($modelAluno);
            
            $this->flashMessenger()->addSuccessMessage("Aluno editado com sucesso");

            return $this->redirect()->toRoute('alunos', array("action" => "detalhes", "id" => $modelAluno->id));
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao editar aluno");
 
           return (new ViewModel())
                            ->setVariable('form', $form)
                            ->setTemplate('aluno/alunos/editar');
        }
    }
    }
 
    
    public function deletarAction()
    {
            $id = (int) $this->params()->fromRoute('id', 0);

            if (!$id) {
                $this->flashMessenger()->addMessage("Aluno não encotrado");

            } else {
                $this->getAlunoTable()->delete($id);
                $this->flashMessenger()->addSuccessMessage("Aluno de ID $id deletado com sucesso!");
            }

            return $this->redirect()->toRoute('alunos');
    }
    
    
    private function getAlunoTable()
    {
       // adicionar service ModelContato a variavel de classe
        if (!$this->alunoTable) {
            $this->alunoTable = $this->getServiceLocator()->get('ModelAluno');
        }
 
        // return vairavel de classe com service ModelContato
        return $this->alunoTable;
    }
}