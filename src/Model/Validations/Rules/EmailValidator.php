<?php

namespace Art\Model\Validations\Rules;


class EmailValidator implements ValidatorFactory
{


    public function validate($string)
    {
        $errors = [];
        if(! isset($string))
            $errors[] =  'You didn\'t introduced email';
        if( !strstr($string,'@') )
            $errors[] = 'Email missing @ character';

        if( !strstr($string, '.') )
            $errors[] =  'Wrong email form';

        return $errors;
    }
}