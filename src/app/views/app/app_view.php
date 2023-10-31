<?php

class AppView
{
    public $data;
    
    public function __construct($data = [])
    {
        $this->data = $data;
    }
    
    public function render()
    {
        require_once __DIR__ . "/../../components/app/app_page.php";
    }
}