<?php
declare(strict_types=1);

namespace app\index\controller;

use app\index\model\User;
use wycto\Controller;
use wycto\Db;

class IndexController extends Controller
{

    function indexAction(){
        return view();
    }

    function testAction(){
        dump('this is test');
    }
}
