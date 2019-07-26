<?php

namespace Art\Model\Validations\Rules;

interface ValidatorFactory
{
    function validate($string);
}