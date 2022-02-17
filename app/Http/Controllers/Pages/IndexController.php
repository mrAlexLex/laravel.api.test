<?php


namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        return view('ticket/index');
    }

    public function create()
    {
        echo 'create';
    }

    public function update()
    {
        echo 'update';
    }

    public function delete()
    {
        echo 'delete';
    }
}
