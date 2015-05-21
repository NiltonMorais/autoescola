<?php

namespace Aluno\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select,
    Zend\Form\Element;

class Contrato extends Form{
    
    protected $alunos;
    
    public function __construct($name = null, array $alunos = null, $id_aluno = null)
    {
        parent::__construct('contrato');
        
        $this->alunos = $alunos;
        $this->id_aluno = $id_aluno;
        
        $this->setInputFilter(new ContratoFilter);
        
        $this->setAttributes(array(
            'method'    => 'post',
            'class'     => 'form-horizontal',
        ));
 
 
        $this->add(array(
            'type' => 'Hidden',
            'name' => 'id',
        ));
 
           
        $aluno = new Select();
        $aluno->setName("aluno_id")
               ->setAttributes(array(
                   'class' => 'form-control',
                   'id'            => 'aluno_id',
                   'placeholder'   => 'Alunos',
                   'value'         => $this->id_aluno,
                   'required'      => true,
                   ))
              
               ->setValueOptions($this->alunos)
               ->setEmptyOption('Selecione um aluno')
               ->setDisableInArrayValidator(true);
        
        $this->add($aluno);
        
        
        
        $this->add(array(
            'name' => 'valor',
            'options' => array(
               'type' => 'text',
                'label' => 'Valor', 
            ),

            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'nome',
                'placeholder'   => 'Valor do contrato',
                'size'          => '10',
                'maxlength'     => '10',
                'onkeydown'     => 'FormataMoeda(this,10,event)',
                'onkeypress'    => 'return maskKeyPress(event)',
                'required'      => true,
                ),
        ));
        
        $this->add(array(
            'name' => 'valor_aula_carro',
            'options' => array(
               'type' => 'text',
                'label' => 'Valor Aula Carro', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'valor_aula_carro',
                'placeholder'   => 'Valor aula prática avulsa de carro',
                'size'          => '10',
                'maxlength'     => '10',
                'onkeydown'     => 'FormataMoeda(this,10,event)',
                'onkeypress'    => 'return maskKeyPress(event)',
                'required'      => true,
                ),
        ));
        
        $this->add(array(
            'name' => 'valor_aula_moto',
            'options' => array(
               'type' => 'text',
                'label' => 'Valor Aulas Práticas(Moto)', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'valor_aula_moto',
                'placeholder'   => 'Valor aula prática avulsa de moto',
                'size'          => '10',
                'maxlength'     => '10',
                'onkeydown'     => 'FormataMoeda(this,10,event)',
                'onkeypress'    => 'return maskKeyPress(event)',
                'required'      => true,
                ),
        ));
        
        $this->add(array(
            'name' => 'valor_aula_teorica',
            'options' => array(
               'type' => 'text',
                'label' => 'Valor Aula Teórica', 
            ),
            'attributes' => array(
                'class'         => 'form-control',
                'id'            => 'valor_aula_teorica',
                'placeholder'   => 'Valor aula avulsa teórica',
                'size'          => '10',
                'maxlength'     => '10',
                'onkeydown'     => 'FormataMoeda(this,10,event)',
                'onkeypress'    => 'return maskKeyPress(event)',
                'required'      => true,
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
 

        // elemento para evitar ataques Cross-Site Request Forgery
        $this->add(new Element\Csrf('security'));
    }
 
}
