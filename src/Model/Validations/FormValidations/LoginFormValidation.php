<?php

namespace Art\Model\Validations\FormValidations;
use Art\Model\DomainObject\User;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\Validations\Rules\EmailValidator;

class LoginFormValidation
{
    /**
     * @var EmailValidator
     */
    private  $validator;

    public function __construct()
    {
        $this->validator = new EmailValidator();
    }

    /**
     * Validates email, password and existence in database
     * @param User $databaseUser
     * @param User $inputUser
     * @return array|null
     */
    public function validateData(User $databaseUser, User $inputUser)
    {
        if($errors = $this->validator->validate($inputUser->getEmail()) )
            return $errors;

        if(!$databaseUser->getId())
           return  ['this account doesn\'t exist in database'];

        if(!password_verify($inputUser->getPassword(),$databaseUser->getPassword() ))
            return ['password doesn\'t match'];

        return null;
    }

}