<?php

namespace Art\Model\Http;

class Request
{
    public static function createRequest()
    {
        return new Request();
    }


    public function getPostVariable()
    {
        return $_POST;
    }

    public function getGETVariable()
    {
        return $_GET;
    }

    public function getPostSpecific($postParameter)
    {
        return $_POST[$postParameter];
    }

    public function getGETSpecific($getParameter)
    {
        return $_GET[$getParameter];
    }

    public function getFileSpecific($fileParameter)
    {
        return $_FILES[$fileParameter];
    }


}