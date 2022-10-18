<?php
namespace App;

class Controller
{

    public function index()
    {
        echo 'home';
    }

    public function page()
    {
        echo 'page';
    }

    public function view($id)
    {
        echo $id;
    }
    public function user($id)
    {
        echo 'User ID ='.$id;
    }

}