<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $test = $this->SettingModel->where('meta_value','>',4)->first();
        die(var_dump($test));
        return view('welcome_message');
    }
}
