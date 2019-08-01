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
        $email = $this->request->getPostSpecific(self::EMAIL);
        $password = $this->request->getPostSpecific(self::PASSWORD);

        return new User($email, $password);
    }



}