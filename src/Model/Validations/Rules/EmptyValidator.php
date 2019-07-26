<?php

namespace Model\Validations\Rules;

class EmptyValidator implements ValidatorFactory
{

    function validate($string)
    {
        if( empty($string) )
            throw new \mysql_xdevapi\Exception('The field is empty');
    }
}