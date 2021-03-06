<?php

namespace Aluno\Form;

use Zend\InputFilter\InputFilter;

class ContratoFilter extends InputFilter{
   
    public function __construct() {

        $this->add(
                array(
                    'name' => 'aluno_id',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Aluno não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        $this->add(
                array(
                    'name' => 'valor',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Valor não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        $this->add(
                array(
                    'name' => 'valor_aula_carro',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Valor das aulas avulsas de carro não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        $this->add(
                array(
                    'name' => 'valor_aula_moto',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Valor das aulas avulsas de moto não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        
        $this->add(
                array(
                    'name' => 'valor_aula_teorica',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Valor das aulas avulsas teóricas não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
  
        
         $this->add(
                array(
                    'name' => 'data_fim',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Data não pode está em branco'),
                            )
                        )
                    )
                )
                );
         
          
          
    }
}
