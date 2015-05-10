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
                'placeholder'   => 'Digite seu telefone principal',
                'required'      => true,
            ),
        ));
 
        $this->add(array(
            'type' => 'Text',
            'name' => 'telefone2',
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'telefone2',
                'placeholder'   => 'Digite seu telefone secundário (opcional)',
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
