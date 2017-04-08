<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;


use Klein\Klein;

abstract class Controller
{
    /**
     * @var string The prefix that is added to all routes under the controller
     */
    protected $prefix = "";
    /**
     * @var array relates uris to controller functions
     */
    protected $routes = [];
    /**
     * Adds routes from the controller.
     * @param $klein Klein the router interface
     */
    public abstract function add_routes($klein);
}