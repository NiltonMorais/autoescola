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
    public $cpf;
    public $end_rua;
    public $end_bairro;
    public $end_cidade;
    public $end_estado;
    
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
        $this->cpf                  = (!empty($data['cpf'])) ? $data['cpf'] : null;                        
        $this->end_rua              = (!empty($data['end_rua'])) ? $data['end_rua'] : null;                        
        $this->end_bairro           = (!empty($data['end_bairro'])) ? $data['end_bairro'] : null;                        
        $this->end_cidade           = (!empty($data['end_cidade'])) ? $data['end_cidade'] : null;                        
        $this->end_estado           = (!empty($data['end_estado'])) ? $data['end_estado'] : null;                        
    }
    
}
