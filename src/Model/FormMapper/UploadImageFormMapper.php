<?php


namespace Art\Controller\Model\FormMapper;

require 'src/constants.php';

use Art\Model\DomainObject\User;
use Art\Model\Http\Request;

class UploadImageFormMapper
{
    /**
     * @var Request
     */
    private $request;



    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getProductFromUploadForm()
    {



    }




}