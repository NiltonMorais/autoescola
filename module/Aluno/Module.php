<?php

namespace Aluno;

use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

use Aluno\Model\Aluno,
    Aluno\Model\AlunoTable;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
  
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AlunoTableGateway' => function ($sm) {
                    // obter adapter db atraves do service manager
                    $adapter = $sm->get('AdapterDb');

                    // configurar ResultSet com nosso model Aluno
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Aluno());

                    // return TableGateway configurado para nosso model Contato
                    return new TableGateway('alunos', $adapter, null, $resultSetPrototype);
                },
                    'ModelAluno' => function ($sm) {
                     return new AlunoTable($sm->get('AlunoTableGateway'));
                },   
            )
        );
    }
    
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'menuAtivo'  => function($sm) {
                    return new View\Helper\MenuAtivo($sm->getServiceLocator()->get('Request'));
                },
                  'message' => function($sm) {
                   return new View\Helper\Message($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
                },
            ),
            'invokables' => array(
                'filter' => 'Aluno\View\Helper\AlunoFilter'
            ),
        );
    }
    
    
    
}
