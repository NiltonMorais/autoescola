<?php
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class HomeController extends AbstractActionController
{
  
    public function indexAction()
    {
        $alunos = $this->getServiceLocator()->get("ModelAluno")->fetchAll();
        $contratos = $this->getServiceLocator()->get("ModelContrato")->fetchAll();
        
        return new ViewModel(array('alunos' => $alunos, 'contratos' => $contratos));
    }
    
    public function sobreAction()
    {
        return new ViewModel();
    }
}