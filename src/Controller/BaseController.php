<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:58 PM
 */

namespace Me\Controller;


use Me\Views\HomePage;

class BaseController extends Controller
{
    protected $prefix = "/";

    protected $protected_routes = [
        "GET:" => "index"
    ];

    public function index() {
        $page = new HomePage();
        $page->execute();
    }
}