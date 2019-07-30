<?php

namespace Model\Validations\Rules;

use Art\Model\Validations\Rules\ValidatorFactory;

class EmailValidator implements ValidatorFactory
{

    private function _verifyA($string)
    {
        if( !strstr($string,'@') )
            throw new \mysql_xdevapi\Exception('Email missing @ character');
    }

    private function _verifyPoint($string)
    {
        if( !strstr($string, '.') )
            throw new \mysql_xdevapi\Exception('Wrong email form');
    }

    public function validate($string)
    {
        $this->_verifyA($string);

        $this->_verifyPoint($string);

    }
}