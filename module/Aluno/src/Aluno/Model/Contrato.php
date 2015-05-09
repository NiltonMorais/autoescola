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

    
    public function exchangeArray($data){ 
        $this->id                   = (!empty($data['id'])) ? $data['id'] : null;               
        $this->valor                = (!empty($data['valor'])) ? $data['valor'] : null;               
        $this->data_inicio          = (!empty($data['data_inicio'])) ? $data['data_inicio'] : null;               
        $this->data_fim             = (!empty($data['data_fim'])) ? $data['data_fim'] : null;               
        $this->data_cadastro        = (!empty($data['data_cadastro'])) ? $data['data_cadastro'] : null;               
        $this->data_alteracao       = (!empty($data['data_alteracao'])) ? $data['data_alteracao'] : null;               
        $this->quant_meses          = (!empty($data['quant_meses'])) ? $data['quant_meses'] : null;                                        
        $this->aluno_id          = (!empty($data['aluno_id'])) ? $data['aluno_id'] : null;                                        
    }
}
