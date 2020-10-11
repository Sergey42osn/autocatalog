<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        //$url = $request->url();

         //dd($url);

        //$article = Article::orderBy('id')->get(array('id','title','short_description'));

        //dd($article);

        return view('app',['currenthome' => 'current',
        					'title'       => 'Автозапчасти б/у'
        					]);
    }
}
