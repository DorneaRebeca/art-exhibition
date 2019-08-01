<?php


namespace Art\Model\Validations\FormValidations;


use Art\Model\DomainObject\User;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\Validations\Rules\EmailValidator;

class RegisterFormValidator
{

    /**
     * @var EmailValidator
     */
    private  $validator;

    public function __construct()
    {
        $this->validator = new EmailValidator();
    }

    public function validateIntroducedData(User $user,$confirmPassword)
    {

        if($errors = $this->validator->validate($user->getEmail()) )
            return $errors;

        $dataBaseUser = PersistenceFactory::getFinderInstance(USER_ENTITY)->findByEmail($user->getEmail());

        if($dataBaseUser->getId()) {
            return ['This email already exists in the database. Try another one'];
        }

        if(!$user->getPassword()) {
            return ['Introduce a password'];
        }

        if(!password_verify($confirmPassword, $user->getPassword())  ) {
            return ['Password doesn\'t match'];
        }
        return null;

    }

}