<?php

namespace Aluno\Form;

use Zend\InputFilter\InputFilter;

class ContratoFilter extends InputFilter{
   
    public function __construct() {

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
                    'name' => 'quant_meses',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Meses não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        $this->add(
                array(
                    'name' => 'data_inicio',
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
