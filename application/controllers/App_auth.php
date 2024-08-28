<?php
class Auth_module
    {
    private $CI;

    function Auth_module()
    {
    $this->CI = &get_instance();
    }

    function index()
    {
        
        redirect(base_url());
    }
}