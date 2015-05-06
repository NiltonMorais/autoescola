<?php
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class HomeController extends AbstractActionController
{
  
    public function indexAction()
    {
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        return new ViewModel();
    }
    
    public function sobreAction()
    {
        return new ViewModel();
    }
}