<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;


use Klein\Klein;
use Me\Views\HomePage;

class Controller
{
    /**
     * @var string The prefix that is added to all routes under the controller
     */
    protected $prefix = "/";
    /**
     * @var array relates uris to controller functions
     */
    protected $routes = [
        "GET:" => "index"
    ];
    /**
     * Adds routes from the controller.
     * @param $klein Klein the router interface
     */
    public function add_routes($klein) {
        foreach($this->routes as $uri => $function) {
            $method = null;
            if(stristr($uri, ":")) {
                $parts = preg_split("/:/", $uri, 2);
                $method = $parts[0];
                $uri = $parts[1];
            }
            $complete = $this->prefix . $uri;
            if($method != null) {
                $klein->respond($method, $complete, [$this, $function]);
            } else {
                $klein->respond($complete, [$this, $function]);
            }
        }
    }

    public function index() {
        $page = new HomePage();
        $page->execute();
    }
}