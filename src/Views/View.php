<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:54 AM
 */

namespace Me\Views;


abstract class View
{
    abstract protected function execute($smarty);
}