<?php


namespace Art\Model\Http;


class Session
{

    public static function createSession()
    {
        return new Session();
    }

    public function getSession()
    {
        session_start();
        return $_SESSION;
    }

    /**
     * Retrieves a session info based on key value
     * @param $sessionParameter
     * @return mixed
     */
    public function getSpecificSession($sessionParameter)
    {
        return $_SESSION[$sessionParameter];

    }

    /**
     * @param $sessionKey
     * @param $sessionValue
     */
    public function setSessionData($sessionKey, $sessionValue)
    {
        $_SESSION[$sessionKey] = $sessionValue;
    }

    public function abortSession()
    {
        session_abort();
    }


}