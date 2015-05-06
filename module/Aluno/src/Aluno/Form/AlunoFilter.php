<?php

namespace Aluno\Form;

use Zend\InputFilter\InputFilter;

class AlunoFilter extends InputFilter{
   
    public function __construct() {

        $this->add(
                array(
                    'name' => 'nome',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Nome não pode está em branco'),
                            )
                        )
                    )
                )
                );
        
        $this->add(
                array(
                    'name' => 'email',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'NotEmpty',
                            'options' => array(
                                'messages' => array('isEmpty' => 'Email não pode está em branco'),
                            )
                        )
                    )
                )
                );
    }
}
