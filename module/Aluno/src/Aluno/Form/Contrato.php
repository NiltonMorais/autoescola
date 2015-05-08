<?php

namespace Aluno\Form;

use Zend\Form\Form;

use Zend\Form\Element;

class Contrato extends Form{
    
   public function __construct($name = null)
    {
        parent::__construct('contrato');
        
        #$this->setInputFilter(new AlunoFilter);
        
        $this->setAttributes(array(
            'method'    => 'post',
            'class'     => 'form-horizontal',
        ));
 
 
        $this->add(array(
            'type' => 'Hidden',
            'name' => 'id',
        ));
 

        $this->add(array(
            'name' => 'valor',
            'options' => array(
               'type' => 'text',
                'label' => 'Valor', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'nome',
                'placeholder'   => 'Valor',
            ),
        ));
        
        $this->add(array(
            'type' => 'text',
            'name' => 'quant_meses',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'quant_meses',
                'placeholder'   => 'Quantidade Meses',
                'required'      => true,
            ),
        ));
        

        $this->add(array(
            'type' => 'Date',
            'name' => 'data_inicio',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'data_inicio',
                'placeholder'   => 'Data de Início',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Date',
            'name' => 'data_fim',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'data_fim',
                'placeholder'   => 'Data de Fim',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Date',
            'name' => 'data_cadastro',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'data_cadastro',
                'placeholder'   => 'Data de Cadastro',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Date',
            'name' => 'data_alteracao',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'data_alteracao',
                'placeholder'   => 'Data de Alteração',
                'required'      => true,
            ),
        ));
 

        // elemento para evitar ataques Cross-Site Request Forgery
        $this->add(new Element\Csrf('security'));
    }
 
}
