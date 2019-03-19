<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() 
    {
        return '通知首页';
    }

    public function show($id)
    {
        return $id;
    }

    public function create()
    {
        return '发布通知';
    }
}
