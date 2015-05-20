<?php

namespace Aluno\Model;

class Contrato {
    
    public $id;
    public $valor;
    public $data_inicio;
    public $data_fim;
    public $data_cadastro;
    public $data_alteracao;
    public $quant_meses;
    public $aluno_id;
    public $valor_aula_carro;
    public $valor_aula_moto;
    public $valor_aula_teorica;

    
    public function exchangeArray($data){ 
        $this->id                   = (!empty($data['id'])) ? $data['id'] : null;               
        $this->valor                = (!empty($data['valor'])) ? $data['valor'] : null;               
        $this->data_inicio          = (!empty($data['data_inicio'])) ? $data['data_inicio'] : null;               
        $this->data_fim             = (!empty($data['data_fim'])) ? $data['data_fim'] : null;               
        $this->data_cadastro        = (!empty($data['data_cadastro'])) ? $data['data_cadastro'] : null;               
        $this->data_alteracao       = (!empty($data['data_alteracao'])) ? $data['data_alteracao'] : null;               
        $this->quant_meses          = (!empty($data['quant_meses'])) ? $data['quant_meses'] : null;                                        
        $this->aluno_id             = (!empty($data['aluno_id'])) ? $data['aluno_id'] : null;                                                                             
        $this->valor_aula_carro     = (!empty($data['valor_aula_carro'])) ? $data['valor_aula_carro'] : null;                                                                                                                                                    
        $this->valor_aula_moto      = (!empty($data['valor_aula_moto'])) ? $data['valor_aula_moto'] : null;                                                                                                                                                    
        $this->valor_aula_teorica   = (!empty($data['valor_aula_teorica'])) ? $data['valor_aula_teorica'] : null;                                                                                                                                                    
    }
}
