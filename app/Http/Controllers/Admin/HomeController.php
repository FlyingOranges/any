<?php

namespace App\Http\Controllers\Admin;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        return view(getThemeView('home.index'));
    }

    public function test()
    {
        if (1 > 2) {
            flash('测试flash')->success();
        } else {
            flash('测试flash')->error();
        }

        return view(getThemeView('home.test'));
    }
}
