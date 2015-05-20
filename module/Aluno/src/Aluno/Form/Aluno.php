<?php

namespace Aluno\Form;

use Zend\Form\Form;

use Zend\Form\Element;

class Aluno extends Form{
    
   public function __construct($name = null)
    {
        parent::__construct('aluno');
        
        $this->setInputFilter(new AlunoFilter);
        
        $this->setAttributes(array(
            'method'    => 'post',
            'class'     => 'form-horizontal',
        ));
 
        
        
 
        $this->add(array(
            'type' => 'Hidden',
            'name' => 'id',
        ));
 

        $this->add(array(
            'name' => 'nome',
            'options' => array(
               'type' => 'text',
                'label' => 'Nome', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'nome',
                'placeholder'   => 'Nome Completo',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'name' => 'end_rua',
            'options' => array(
               'type' => 'text',
                'label' => 'Endereço', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'end_rua',
                'placeholder'   => 'Endereço Completo',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'name' => 'end_bairro',
            'options' => array(
               'type' => 'text',
                'label' => 'Bairro', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'end_bairro',
                'placeholder'   => 'Bairro',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'name' => 'end_cidade',
            'options' => array(
               'type' => 'text',
                'label' => 'Cidade', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'end_cidade',
                'placeholder'   => 'Cidade',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'name' => 'end_estado',
            'options' => array(
               'type' => 'text',
                'label' => 'Estado', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'end_estado',
                'placeholder'   => 'Estado',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'name' => 'cpf',
            'options' => array(
               'type' => 'text',
                'label' => 'CPF', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'cpf',
                'placeholder'   => 'CPF',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Email',
            'name' => 'email',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'email',
                'placeholder'   => 'Email',
                'required'      => true,
            ),
        ));
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'sexo',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'sexo',
                'placeholder'   => 'Sexo',
                'required'      => true,
            ),
        ));
 

        $this->add(array(
            'type' => 'Text',
            'name' => 'telefone',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'telefone',
                'placeholder'   => 'Telefone principal',
                'required'      => true,
            ),
        ));
 
        $this->add(array(
            'type' => 'Text',
            'name' => 'telefone2',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'telefone2',
                'placeholder'   => 'Telefone secundário (opcional)',
            ),
        ));
        
        $this->add(array(
            'type' => 'Date',
            'name' => 'data_nascimento',
            'format' => 'Y-m-d',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'data_nascimento',
                'placeholder'   => 'Data de Nascimento',
                'value'   => 'Data de Nascimento',
              /*  'min'  => '2015-04-01',
                'max'  => '2015-05-15',*/
                'required'      => true,
            ),
        ));
 

        // elemento para evitar ataques Cross-Site Request Forgery
        $this->add(new Element\Csrf('security'));
    }
 
}
