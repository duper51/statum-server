<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:12 PM
 */

namespace Me;


use Me\Controller\Controller;

class Kernel
{
    public $controllers = ['ApiController'];
    public function __construct($klein) {
        foreach($this->controllers as $controller) {
            /** @var Controller $obj */
            $class = "\\Me\\Controller\\" . $controller;
            $obj = new $class();
            $obj->add_routes($klein);
        }
    }
}