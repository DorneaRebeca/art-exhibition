<?php

namespace Art\Model\FormMapper;

use Art\Model\DomainObject\User;
use Art\Model\Http\Request;


class LoginFormMapper
{
    private const EMAIL = 'userEmail';
    private const PASSWORD = 'userPassword';

    /**
     * @var Request
     */
    private $request;



    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function getUserFromLoginForm()
    {
        var_dump($_POST);
        $email = $this->request->getPostSpecific(self::EMAIL);
        $password = $this->request->getPostSpecific(self::PASSWORD);

        //$encrypted = password_hash($password, PASSWORD_BCRYPT);

        return new User($email, $password);
    }



}