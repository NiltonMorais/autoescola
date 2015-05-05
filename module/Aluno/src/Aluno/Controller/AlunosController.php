<?php
 
namespace Aluno\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
 
class AlunosController extends AbstractActionController
{
   
    public function indexAction()
    {
    }
 
 
    
    public function novoAction()
    {
    }
 
    
    
    public function adicionarAction()
    {
         // obtém a requisição
    $request = $this->getRequest();
 
    // verifica se a requisição é do tipo post
    if ($request->isPost()) {
        // obter e armazenar valores do post
        $postData = $request->getPost()->toArray();
        $formularioValido = false;
 
        // verifica se o formulário segue a validação proposta
        if ($formularioValido) {
            // aqui vai a lógica para adicionar os dados à tabela no banco
            // 1 - solicitar serviço para pegar o model responsável pela adição
            // 2 - inserir dados no banco pelo model
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Aluno criado com sucesso");
 
            // redirecionar para action index no controller contatos
            return $this->redirect()->toRoute('alunos');
        } else {
            // adicionar mensagem de erro
            $this->flashMessenger()->addErrorMessage("Erro ao criar contato");
 
            // redirecionar para action novo no controllers contatos
            return $this->redirect()->toRoute('alunos', array('action' => 'novo'));
        }
    }
    }
 
    
    
    public function detalhesAction()
    {
        // filtra id passsado pela url
    $id = (int) $this->params()->fromRoute('id', 0);
 
    // se id = 0 ou não informado redirecione para contatos
    if (!$id) {
        // adicionar mensagem
        $this->flashMessenger()->addMessage("Aluno não encotrado");
 
        // redirecionar para action index
        return $this->redirect()->toRoute('alunos');
    }
 
    // aqui vai a lógica para pegar os dados referente ao contato
    // 1 - solicitar serviço para pegar o model responsável pelo find
    // 2 - solicitar form com dados desse contato encontrado
    // formulário com dados preenchidos
    $form = array(
        'nome' => 'Igor Rocha',
        "telefone_principal" => "(085) 8585-8585",
        "telefone_secundario" => "(085) 8585-8585",
        "data_criacao" => "02/03/2013",
        "data_atualizacao" => "02/03/2013",
        );
 
    // dados eviados para detalhes.phtml
    return array('id' => $id, 'form' => $form);
    }
 
    
    
    public function editarAction()
    {
         // filtra id passsado pela url
    $id = (int) $this->params()->fromRoute('id', 0);
 
    // se id = 0 ou não informado redirecione para contatos
    if (!$id) {
        // adicionar mensagem de erro
        $this->flashMessenger()->addMessage("Aluno não encotrado");
 
        // redirecionar para action index
        return $this->redirect()->toRoute('alunos');
    }
 
    // aqui vai a lógica para pegar os dados referente ao contato
    // 1 - solicitar serviço para pegar o model responsável pelo find
    // 2 - solicitar form com dados desse contato encontrado
 
    // formulário com dados preenchidos
    $form = array(
        'nome'                  => 'Igor Rocha',
        "telefone_principal"    => "(085) 8585-8585",
        "telefone_secundario"   => "(085) 8585-8585",
    );
 
    // dados eviados para editar.phtml
    return array('id' => $id, 'form' => $form);
    }
 
    
    public function atualizarAction()
    {
        // obtém a requisição
    $request = $this->getRequest();
 
    // verifica se a requisição é do tipo post
    if ($request->isPost()) {
        // obter e armazenar valores do post
        $postData = $request->getPost()->toArray();
        $formularioValido = true;
 
        // verifica se o formulário segue a validação proposta
        if ($formularioValido) {
            // aqui vai a lógica para editar os dados à tabela no banco
            // 1 - solicitar serviço para pegar o model responsável pela atualização
            // 2 - editar dados no banco pelo model
 
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Aluno editado com sucesso");
 
            // redirecionar para action detalhes
            return $this->redirect()->toRoute('alunos', array("action" => "detalhes", "id" => $postData['id'],));
        } else {
            // adicionar mensagem de erro
            $this->flashMessenger()->addErrorMessage("Erro ao editar aluno");
 
            // redirecionar para action editar
            return $this->redirect()->toRoute('alunos', array('action' => 'editar', "id" => $postData['id'],));
        }
    }
    }
 
    
    public function deletarAction()
    {
        // filtra id passsado pela url
    $id = (int) $this->params()->fromRoute('id', 0);
 
    // se id = 0 ou não informado redirecione para contatos
    if (!$id) {
        // adicionar mensagem de erro
        $this->flashMessenger()->addMessage("Aluno não encotrado");
 
    } else {
        // aqui vai a lógica para deletar o contato no banco
        // 1 - solicitar serviço para pegar o model responsável pelo delete
        // 2 - deleta contato
 
        // adicionar mensagem de sucesso
        $this->flashMessenger()->addSuccessMessage("Aluno de ID $id deletado com sucesso!");
 
    }
 
    // redirecionar para action index
    return $this->redirect()->toRoute('alunos');
    }
}