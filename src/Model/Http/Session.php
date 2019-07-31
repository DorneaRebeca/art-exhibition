<?php


namespace Art\Model\Http;


class Session
{

    public static $sessionInstance;

    public static function createSession()
    {
        if(!isset(self::$sessionInstance) || self::$sessionInstance == null)
        {
            session_start();
            self::$sessionInstance = new self();
        }

        return self::$sessionInstance;
    }

    public function getSession()
    {
        return $_SESSION;
    }

    /**
     * Retrieves a session info based on key value
     * @param $sessionParameter
     * @return mixed
     */
    public function getSpecificSession($sessionParameter)
    {
        if(!isset($_SESSION[$sessionParameter]))
            return false;

        return $_SESSION[$sessionParameter];

    }

    public function unsetSessionData($sessionParameter)
    {
        unset($_SESSION[$sessionParameter]);
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
        if(isset(self::$sessionInstance))
        {
            session_clo();
            self::$sessionInstance = null;
        }

    }


}