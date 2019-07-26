<?php

namespace Model\Validations\Rules;

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