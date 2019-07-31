<?php


namespace Art\Model\FormMapper;


use Art\Model\DomainObject\User;
use Art\Model\Http\Request;

class RegisterFormMapper
{
    private const NAME='name';
    private const EMAIL='email';
    private const PASSWORD='password';


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
        $name = $this->request->getPostSpecific(self::NAME);
        $email = $this->request->getPostSpecific(self::EMAIL);
        $password = $this->request->getPostSpecific(self::PASSWORD);

        $encrypted = password_hash($password, PASSWORD_BCRYPT);

        return new User( $email, $password, $name);
    }

}