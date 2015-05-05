<?php
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
 
class HomeController extends AbstractActionController
{
  
    public function indexAction()
    {
        return new ViewModel();
    }
}