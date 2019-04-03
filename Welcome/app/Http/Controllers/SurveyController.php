<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index() 
    {
        return 'survey';
    }

    public function show($id)
    {
        return $id;
    }
}
