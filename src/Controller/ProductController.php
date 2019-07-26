<?php


namespace Art\Controller;


class ProductController
{
    public static function showProducts()
    {
        require 'src/View/Templates/HomePageForm.php';
        echo "gugu".PHP_EOL;
    }
}