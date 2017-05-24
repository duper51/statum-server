<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:12 PM
 */

namespace Me;


use Me\Controller\Controller;
use Illuminate\Database\Capsule\Manager as Capsule;

class Kernel
{
    public $controllers = ['Controller', 'ApiController'];
    public $config;
    protected static $instance;
    public function __construct($klein) {
        foreach($this->controllers as $controller) {
            /** @var Controller $obj */
            $class = "\\Me\\Controller\\" . $controller;
            $obj = new $class();
            $obj->add_routes($klein);
        }

        $this->config = parse_ini_file(dirname(__DIR__) . "/config/config.ini", true);
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $this->config['database']['hostname'],
            'database'  => $this->config['database']['db'],
            'username'  => $this->config['database']['username'],
            'password'  => $this->config['database']['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();

        Kernel::$instance = $this;
    }

    public static function getInstance() {
        return Kernel::$instance;
    }
}