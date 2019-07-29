<?php

namespace Art\View;

class Request
{



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


}