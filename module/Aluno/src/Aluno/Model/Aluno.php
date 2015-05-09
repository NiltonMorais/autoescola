<?php

namespace Aluno\Model;

class Aluno {
    
    public $id;
    public $nome;
    public $email;
    public $sexo;
    public $telefone;
    public $telefone2;
    public $data_nascimento;
    public $data_cadastro;
    public $data_alteracao;
    #public $contrato_id;
    
    public function exchangeArray($data){ 
        $this->id                   = (!empty($data['id'])) ? $data['id'] : null;               
        $this->nome                 = (!empty($data['nome'])) ? $data['nome'] : null;               
        $this->email                = (!empty($data['email'])) ? $data['email'] : null;               
        $this->sexo                 = (!empty($data['sexo'])) ? $data['sexo'] : null;               
        $this->telefone             = (!empty($data['telefone'])) ? $data['telefone'] : null;               
        $this->telefone2            = (!empty($data['telefone2'])) ? $data['telefone2'] : null;               
        $this->data_nascimento      = (!empty($data['data_nascimento'])) ? $data['data_nascimento'] : null;               
        $this->data_cadastro        = (!empty($data['data_cadastro'])) ? $data['data_cadastro'] : null;               
        $this->data_alteracao       = (!empty($data['data_alteracao'])) ? $data['data_alteracao'] : null;               
       # $this->contrato_id          = (!empty($data['contrato_id'])) ? $data['contrato_id'] : null;               
    }
    
}
