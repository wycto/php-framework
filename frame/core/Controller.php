<?php
namespace wycto;

class Controller
{
    protected $request;

    function __construct()
    {
        $this->request = Request::instance();
    }
}
